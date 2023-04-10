<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(2),
            'price' => $this->faker->numberBetween(1500, 10000),
            'price2' => $this->faker->numberBetween(1500, 10000),
            'price3' => $this->faker->numberBetween(1500, 10000),
            'slug' => $this->faker->word().'-'.$this->faker->numberBetween(1,99),
            'is_published' => $this->faker->numberBetween(0,1),
            'seo_title' => $this->faker->word(5),
            'seo_description' => $this->faker->sentence(10),
            'seo_text' => $this->faker->sentence(50),
            'seats' => $this->faker->numberBetween(2, 5),
            'year' => $this->faker->numberBetween(2015, 2021),
        ];
    }
}
