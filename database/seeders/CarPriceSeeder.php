<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarPrice;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CarPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $car = Car::query()->first();

        CarPrice::query()->insert([
            'car_id' => $car->id,
            'price' => 1200,
            'price2' => 1300,
            'price3' => 1400,
            'start' => Carbon::createFromFormat('Y-m-d H:i:s', '2020-05-01 00:00:00')->toDateTimeString(),
            'end' => Carbon::createFromFormat('Y-m-d H:i:s', '2020-09-01 00:00:00')->toDateTimeString(),
        ]);
    }
}
