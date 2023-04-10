<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarMeta;
use App\Models\Meta;
use Illuminate\Database\Seeder;

class CarMetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cars = Car::all();
        $brand = Meta::query()->where('type', 'brand')->first();
        foreach ($cars as $car) {
            CarMeta::query()->create([
               'car_id' => $car->id,
               'meta_id' => $brand->id,
            ]);
        }
    }
}
