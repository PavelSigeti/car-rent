<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Services\Interfaces\ImagesContract;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class ImageSeeder extends Seeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
        $this->imagesContract = app( ImagesContract::class);
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $car = Car::query()->first();

        $this->imagesContract->saveMainImage(UploadedFile::fake()->image('photo.jpg'), $car->id);
    }
}
