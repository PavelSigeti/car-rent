<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Place::query()->create([
            'name' => 'Test',
            'title' => 'Test',
            'delivery_price' => 200,
            'seo_title' => 'Just title',
            'seo_description' => 'Just description',
            'slug' => 'test',
        ]);
    }
}
