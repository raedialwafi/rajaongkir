<?php

namespace Tests\Unit\Factories;

use App\Models\Province;
use Database\Factories\ProvinceFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProvinceFactoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_province_with_valid_data()
    {
        // Create a Province instance using the ProvinceFactory
        $province = Province::factory()->create();

        // Assert that the province was created successfully
        $this->assertDatabaseHas('provinces', [
            'province_id' => $province->province_id,
            'name' => $province->name,
        ]);
    }

    /**
     * Define the factory's corresponding model.
     *
     * @return string
     */
    protected function getFactoryClass()
    {
        return ProvinceFactory::class;
    }
}
