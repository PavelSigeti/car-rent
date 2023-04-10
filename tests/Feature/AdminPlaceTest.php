<?php

namespace Tests\Feature;

use App\Models\Place;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminPlaceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_place_index()
    {
        $this->seed(UserSeeder::class);

        $user = User::query()->where('role', 1)->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/dashboard/place');

        $response->assertStatus(200);
    }

    public function test_place_edit()
    {
        $this->seed();

        $user = User::query()->where('role', 1)->first();

        $place = Place::query()->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/dashboard/place/'.$place->id.'/edit');

        $response->assertStatus(200);
    }

    public function test_place_store()
    {
        $this->seed();

        $user = User::query()->where('role', 1)->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/dashboard/place', [
                'name' => 'post name',
                'title' => 'title',
                'delivery_price' => 500,
                'extra_price' => 100,
                'small_text' => 'Just small text',
                'big_text' => 'Just big test',
                'seo_title' => 'seo_title',
                'seo_description' => 'seo_description',
                'slug' => 'place-test-slug',
            ]);
        $place = Place::query()->where('slug', 'place-test-slug')->first();
        $response->assertRedirectContains('/dashboard/place/'.$place->id.'/edit');
    }

    public function test_place_update()
    {
        $this->seed();

        $user = User::query()->where('role', 1)->first();

        $place = Place::query()->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->patch('/dashboard/place/'.$place->id, [
                'name' => 'post name update',
                'title' => 'title',
                'delivery_price' => 500,
                'extra_price' => 100,
                'small_text' => 'Just small text',
                'big_text' => 'Just big test',
                'seo_title' => 'seo_title',
                'seo_description' => 'seo_description',
                'slug' => 'place-test-slug-update',
                'min_days' => 0,
                'min_days_price' => 0,
            ]);

        $response->assertRedirectContains('/dashboard/place/'.$place->id.'/edit');
    }
}
