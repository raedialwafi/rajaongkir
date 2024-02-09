<?php

namespace Tests\Unit\Traits\Response;

use App\Traits\Response\CityResponseTrait;
use Tests\TestCase;

class CityResponseTraitTest extends TestCase
{
    use CityResponseTrait;

    /** @test */
    public function it_can_generate_city_response()
    {
        // Mock city data
        $cityData = [
            'city_id' => 123,
            'city_name' => 'Test City',
            'province_id' => 456,
            'type' => 'Test Type',
            'postal_code' => '23234',
        ];

        // Generate response using the trait method
        $response = $this->PublicCityResponse($cityData);

        // Assert the response structure and values
        $this->assertEquals([
            'id' => 123,
            'city_id' => 123,
            'name' => 'Test City',
            'province_id' => 456,
            'type' => 'Test Type',
            'postal_code' => '23234',
        ], $response);
    }
}
