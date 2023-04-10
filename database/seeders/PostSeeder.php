<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::query()->insert([
            'title' => 'Test',
            'text' => 'Some text',
            'slug' => 'post-slug',
            'seo_title' => 'Seo title',
            'seo_description' => 'Seo description',
        ]);
    }
}
