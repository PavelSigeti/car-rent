<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminPostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_index()
    {
        $this->seed(UserSeeder::class);

        $user = User::query()->where('role', 1)->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/dashboard/place');

        $response->assertStatus(200);
    }

    public function test_post_edit()
    {
        $this->seed();

        $user = User::query()->where('role', 1)->first();

        $post = Post::query()->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/dashboard/post/'.$post->id.'/edit');

        $response->assertStatus(200);
    }

    public function test_post_store()
    {
        $this->seed();

        $user = User::query()->where('role', 1)->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/dashboard/post', [
                'title' => 'title',
                'text' => 'text',
                'slug' => 'test-slug',
                'seo_title' => 'seo_title',
                'seo_description' => 'seo_title',
            ]);

        $post = Post::query()->where('slug', 'test-slug')->first();

        $response->assertRedirectContains('/dashboard/post/'.$post->id.'/edit');
    }

    public function test_post_update()
    {
        $this->seed();

        $user = User::query()->where('role', 1)->first();

        $post = Post::query()->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->patch('/dashboard/post/'.$post->id, [
                'title' => 'title update',
                'text' => 'text',
                'slug' => 'test-slug-update',
                'seo_title' => 'seo_title',
                'seo_description' => 'seo_title',
            ]);

        $response->assertRedirectContains('/dashboard/post/'.$post->id.'/edit');
    }
}
