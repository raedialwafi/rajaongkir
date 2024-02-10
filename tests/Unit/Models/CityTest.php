<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\City;
use App\Models\Province;

class CityTest extends TestCase
{
    use RefreshDatabase;

    public function testCityCanBeCreatedWithFillableAttributes()
    {
        $city = City::factory()->create();

        $this->assertInstanceOf(City::class, $city);

        $this->assertEquals($city->name, $city->name);
        $this->assertEquals($city->province_id, $city->province_id);
    }
}
