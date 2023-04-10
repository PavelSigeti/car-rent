<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\Meta;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminCarTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_guest()
    {
        $this->seed(UserSeeder::class);

        $response = $this->get('/dashboard');

        $response->assertRedirectContains('/logout');
    }

    public function test_dashboard()
    {
        $this->seed(UserSeeder::class);

        $user = User::query()->where('role', 1)->first();

        $response = $this->actingAs($user)
                        ->withSession(['banned' => false])
                        ->get('/dashboard');

        $response->assertStatus(200);
    }
    public function test_car_store()
    {
        $this->seed();

        $user = User::query()->where('role', 1)->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/dashboard/car', [
                'name' => 'Test',
                'price' => '123',
                'price2' => '125',
                'price3' => '127',
                'is_published' => true,
                'seo_title' => 'Test value',
                'seo_description' => 'Test value',
                'engine' => '1',
                'meta' => [1],
                'seats' => '5',
                'year' => '2000',
                'home_place' => 0,
            ]);

        $response->assertRedirectContains('/dashboard/car/');
    }

    public function test_car_delete()
    {
        $this->seed();
        $user = User::query()->where('role', 1)->first();
        $car = Car::query()->first();
        $response = $this->actingAs($user)
                ->withSession(['banned' => false])
                ->delete('/dashboard/car/'.$car->id);

        $response->assertRedirect('/dashboard/car');

    }

    public function test_car_edit()
    {
        $this->seed();
        $user = User::query()->where('role', 1)->first();
        $car = Car::query()->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/dashboard/car/'.$car->id.'/edit');

        $response->assertStatus(200);
    }
    public function test_car_update()
    {
        $this->seed();
        $user = User::query()->where('role', 1)->first();
        $car = Car::query()->first();
        $meta = Meta::query()->first();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->patch('/dashboard/car/'.$car->id,[
                'name' => 'name',
                'price' => 1234,
                'price2' => 1234,
                'price3' => 1234,
                'is_published' => 1,
                'seo_title' => 'seo_title',
                'seo_description' => 'seo_description',
                'seo_text' => 'seo_text',
                'engine' => 5,
                'seats' => 4,
                'year' => 2020,
                'msg' => 'Just msg',
                'zalog' => 10000,
                'home_place' => 0,
                'discount' => 'some value',
                'meta' => [$meta->id],
            ]);
        $response->assertRedirectContains('/dashboard/car/'.$car->id.'/edit');
    }
}
