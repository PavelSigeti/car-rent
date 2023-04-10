<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\CarPrice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarPriceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_car_price_store()
    {
        $this->seed();
        $user = User::query()->where('role', 1)->first();

        $car = Car::query()->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/dashboard/car/'.$car->id.'/prices', [
                'car_id' => $car->id,
                'price' => 1200,
                'price2' => 1300,
                'price3' => 1400,
                'start' => Carbon::createFromFormat('Y-m-d H:i:s', '2020-01-11 00:00:00')->toDateTimeString(),
                'end' => Carbon::createFromFormat('Y-m-d H:i:s', '2020-03-01 00:00:00')->toDateTimeString(),
            ]);

        $response->assertRedirectContains('/dashboard/car/'.$car->id.'/edit');
    }

    public function test_car_price_update()
    {
        $this->seed();
        $user = User::query()->where('role', 1)->first();

        $carPrice = CarPrice::query()->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->patch('/dashboard/car/price/'.$carPrice->id, [
                'price' => 1200,
                'price2' => 1300,
                'price3' => 1400,
            ]);

        $this->assertTrue($response['result']);
    }

    public function test_car_delete()
    {
        $this->seed();
        $user = User::query()->where('role', 1)->first();

        $carPrice = CarPrice::query()->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->delete('dashboard/car/price/'.$carPrice->id.'/delete');

        $response->assertRedirectContains('/dashboard/car/'.$carPrice->car_id.'/edit');
    }
}
