<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CarSeeder::class);
        $this->call(MetaSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(CarMetaSeeder::class);
        $this->call(PlaceSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(CarPriceSeeder::class);
        $this->call(ServiceSeeder::class);
        // $this->call(ImageSeeder::class);
    }
}
