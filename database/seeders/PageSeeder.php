<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::query()->insert([
            'title' => 'title',
            'text' => 'text',
            'slug' => 'page-slug',
            'seo_title' => 'seo_title',
            'seo_description' => 'seo_description',
        ]);
    }
}
