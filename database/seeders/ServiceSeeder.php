<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::query()->create([
           'name' => 'Детское кресло',
           'price' => 0,
        ]);

        Service::query()->create([
            'name' => 'Бустер',
            'price' => 0,
        ]);
    }
}
