<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminPageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_page_index()
    {
        $this->seed(UserSeeder::class);

        $user = User::query()->where('role', 1)->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/dashboard/page');

        $response->assertStatus(200);
    }

    public function test_page_edit()
    {
        $this->seed();

        $user = User::query()->where('role', 1)->first();

        $page = Page::query()->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/dashboard/page/'.$page->id.'/edit');

        $response->assertStatus(200);
    }

    public function test_page_store()
    {
        $this->seed();

        $user = User::query()->where('role', 1)->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/dashboard/page', [
                'title' => 'title-test',
                'text' => 'text-test',
                'slug' => 'page-slug-test',
                'seo_title' => 'seo_title-test',
                'seo_description' => 'seo_description-test',
            ]);
        $page = Page::query()->where('slug', 'page-slug-test')->first();
        $response->assertRedirectContains('/dashboard/page/'.$page->id.'/edit');
    }

    public function test_page_update()
    {
        $this->seed();

        $user = User::query()->where('role', 1)->first();

        $page = Page::query()->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->patch('/dashboard/page/'.$page->id, [
                'title' => 'title-test2',
                'text' => 'text-test2',
                'slug' => 'page-slug-test2',
                'seo_title' => 'seo_title-test2',
                'seo_description' => 'seo_description-test2',
            ]);

        $response->assertRedirectContains('/dashboard/page/'.$page->id.'/edit');
    }
}
