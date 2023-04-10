<?php

namespace Database\Factories;

use App\Models\Meta;
use Illuminate\Database\Eloquent\Factories\Factory;

class MetaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Meta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['body', 'class', 'brand', 'transmission']),
            'title' => $this->faker->randomElement(['Кузов', 'Класс', 'Бренд', 'Коробка передач']),
            'name' => $this->faker->word(),
            'slug' => $this->faker->word().'-'.$this->faker->word().'-'.$this->faker->word(),
            'seo_title' => $this->faker->word().'-'.$this->faker->numberBetween(1,99),
            'seo_description' => $this->faker->word(),
            'big_title' => $this->faker->word(),
            'small_title' => $this->faker->word(),
            ];
    }
}
