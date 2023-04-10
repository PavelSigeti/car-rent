<?php

namespace Tests\Feature;

use App\Models\Meta;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminMetaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_meta_index()
    {
        $this->seed(UserSeeder::class);

        $user = User::query()->where('role', 1)->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/dashboard/meta');

        $response->assertStatus(200);
    }

    public function test_meta_edit()
    {
        $this->seed();

        $user = User::query()->where('role', 1)->first();

        $meta = Meta::query()->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/dashboard/meta/'.$meta->id.'/edit');

        $response->assertStatus(200);
    }

    public function test_meta_store()
    {
        $this->seed();
        $user = User::query()->where('role', 1)->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/dashboard/meta', [
                'type' => 'class',
                'title' => 'Just meta',
                'name' => 'Just meta name',
                'slug' => 'meta-test-slug',
                'seo_title' => 'seo_title',
                'seo_description' => 'seo_description',
                'big_title' => 'big_title',
                'small_title' => 'small_title',
            ]);

        $response->assertRedirectContains('/dashboard/meta/');
    }

    public function test_meta_update()
    {
        $this->seed();
        $user = User::query()->where('role', 1)->first();

        $meta = Meta::query()->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->patch('/dashboard/meta/'.$meta->id, [
                'type' => 'class',
                'title' => 'Just meta test',
                'name' => 'Just meta name test',
                'slug' => 'meta-test-slug',
                'seo_title' => 'seo_title',
                'seo_description' => 'seo_description',
                'big_title' => 'big_title',
                'small_title' => 'small_title',
            ]);

        $response->assertRedirectContains('/dashboard/meta/'.$meta->id.'/edit');
    }

    public function test_meta_delete()
    {
        $this->seed();
        $user = User::query()->where('role', 1)->first();

        $meta = Meta::query()->first();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->delete('/dashboard/meta/'.$meta->id);

        $response->assertRedirectContains('/dashboard/meta');
    }
}
