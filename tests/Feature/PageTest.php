<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\Place;
use App\Models\Post;
use Database\Seeders\CarSeeder;
use Database\Seeders\PlaceSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_home()
    {
        $this->seed();

        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_park()
    {
        $this->seed();

        $response = $this->get('/car');
        $response->assertStatus(200);
    }

    public function test_place()
    {
        $this->seed();

        $place = Place::query()->first();
        $uri = '/' . $place->slug;
        $response = $this->get($uri);
        $response->assertStatus(200);
    }

    public function test_car()
    {
        $this->seed();

        $car = Car::query()->first();
        $uri = '/car/' . $car->slug;

        $response = $this->get($uri);
        $response->assertStatus(200);
    }

    public function test_car_unpublished()
    {
        $this->seed();

        $car = Car::factory()->create([
            'is_published' => 0,
        ]);
        $uri = '/car/' . $car->slug;

        $response = $this->get($uri);
        $response->assertStatus(404);
    }

    public function test_order()
    {
        $this->seed(PlaceSeeder::class);
        $car = Car::factory()->create();
        $place = Place::query()->first();
        $uri = '/car/'. $car->id .'/order/';
        $response = $this->postJson($uri, [
                'date' => ' 09.04.2030 - 11.04.2030',
                'start_place' => $place->id,
                'start_time' => '12:00',
                'end_place' => $place->id,
                'end_time' => '12:00',
                'name' => 'Тестовый',
                'phone' => '79781112233',
            ]
        );

        $this->assertTrue($response['created']);
    }

    public function test_blog()
    {
        $this->seed();

        $response = $this->get('/blog');
        $response->assertStatus(200);
    }
    public function test_post()
    {
        $this->seed();

        $place = Post::query()->first();
        $uri = '/blog/' . $place->slug;
        $response = $this->get($uri);
        $response->assertStatus(200);
    }

    public function test_dash()
    {
        $response = $this->get('/dash');
        $response->assertStatus(200);
    }
}
