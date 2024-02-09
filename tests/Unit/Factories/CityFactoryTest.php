<?php

namespace Tests\Unit\Factories;

use App\Models\City;
use App\Models\Province;
use Database\Factories\CityFactory;
use Database\Factories\ProvinceFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CityFactoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_city_with_valid_province()
    {
        // Create a Province instance using the ProvinceFactory
        $province = Province::factory()->create();

        // Create a City instance using the CityFactory and associate it with the created province
        $city = City::factory()->create(['province_id' => $province->province_id]);

        // Assert that the city was created successfully
        $this->assertDatabaseHas('cities', [
            'city_id' => $city->city_id,
            'province_id' => $province->province_id,
            'type' => $city->type,
            'name' => $city->name,
            'postal_code' => $city->postal_code,
        ]);
    }

    /** @test */
    public function it_creates_city_with_associated_province()
    {
        // Create a Province instance using the ProvinceFactory
        $province = ProvinceFactory::new()->create();

        // Create a City instance using the CityFactory and associate it with the created province
        $city = City::factory()->create([
            'province_id' => $province->province_id,
        ]);

        // Assert that the city was created successfully
        $this->assertDatabaseHas('cities', [
            'city_id' => $city->city_id,
            'province_id' => $province->province_id,
            'name' => $city->name,
            // Add other assertions as needed
        ]);
    }

    /**
     * Define the factory's corresponding model.
     *
     * @return string
     */
    protected function getFactoryClass()
    {
        return CityFactory::class;
    }
}
