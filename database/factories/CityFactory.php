<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    protected $model = City::class;

    public function definition()
    {
        return [
            'city_id' => $this->faker->unique()->randomNumber(5),
            'province_id' => Province::factory(),
            'type' => $this->faker->word,
            'name' => $this->faker->city,
            'postal_code' => $this->faker->postcode,
        ];
    }
}