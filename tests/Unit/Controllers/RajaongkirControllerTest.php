<?php

// tests/Feature/RajaongkirControllerTest.php

namespace tests\Unit\Controllers;

use App\Models\City;
use App\Models\Province;
use App\Traits\RajaOngkirRequestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class RajaongkirControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_search_provinces_with_swap_db_true()
    {
        // Activate swap database
        Config::set('app.SWAPAPI_VALUE', true);

        // Mock Rajaongkir API response for province
        $rajaongkirApiResponse = ['id' => 1, 'province_id' => 1, 'name' => 'Fake Province'];
        $this->mockRajaongkirApi($rajaongkirApiResponse, null);

        // Mock the getRajaongkirData function to return the desired response
        $this->mockRajaongkirData($rajaongkirApiResponse);

        // Hit the API endpoint
        $response = $this->withBasicAuth(env('PARTNER_IN_AUTH_USERNAME'), env('PARTNER_IN_AUTH_PASSWORD'))
                        ->get('/api/search/provinces?id=1');

        // Assert HTTP status OK (200)
        $response->assertOk();

        // Assert the response structure or any specific response data
        $response->assertJsonStructure(['id', 'province_id', 'name']);
    }

    /** @test */
    public function it_can_search_provinces_with_swap_db_false()
    {
        // Deactivate swap database
        Config::set('app.SWAPAPI_VALUE', false);

        // Create a Province instance using the ProvinceFactory
        $province = Province::factory()->create();

        // Hit the API endpoint
        $response = $this->withBasicAuth(env('PARTNER_IN_AUTH_USERNAME'), env('PARTNER_IN_AUTH_PASSWORD'))
                         ->get('/api/search/provinces?id=' . $province->id);

        // Assert HTTP status OK (200)
        $response->assertOk();

        // Assert the response structure or any specific response data
        $response->assertJsonStructure(['id', 'province_id', 'name']);

        // Assert that the data has been retrieved from the main database
        $response->assertJson([
            'id' => $province->id,
            'province_id' => $province->province_id,
            'name' => $province->name,
        ]);
    }

    /** @test */
    public function it_can_search_cities_with_swap_db_true()
    {
        // Activate swap database
        Config::set('app.SWAPAPI_VALUE', true);

        // Mock Rajaongkir API response for city
        $this->mockRajaongkirApi(['id' => 1, 'city_id' => 1, 'province_id' => 2, 'type' => 'kabupaten', 'name' => 'Fake City', 'postal_code' => '12345'], null);

        // Hit the API endpoint
        $response = $this->withBasicAuth(env('PARTNER_IN_AUTH_USERNAME'), env('PARTNER_IN_AUTH_PASSWORD'))
                         ->get('/api/search/cities?id=1');

        // Assert HTTP status OK (200)
        $response->assertOk();

        // Assert the response structure or any specific response data
        $response->assertJsonStructure(['id', 'city_id', 'name', 'province_id', 'type']);
    }

    /** @test */
    public function it_can_search_cities_with_swap_db_false()
    {
        // Deactivate swap database
        Config::set('app.SWAPAPI_VALUE', false);

        // Create a City instance using the CityFactory
        $city = City::factory()->create();

        // Hit the API endpoint
        $response = $this->withBasicAuth(env('PARTNER_IN_AUTH_USERNAME'), env('PARTNER_IN_AUTH_PASSWORD'))
                         ->get('/api/search/cities?id=' . $city->id);

        // Assert HTTP status OK (200)
        $response->assertOk();

        // Assert the response structure or any specific response data
        $response->assertJsonStructure(['id', 'city_id', 'name', 'province_id', 'type']);

        // Assert that the data has been retrieved from the main database
        $response->assertJson([
            'id' => $city->id,
            'city_id' => $city->city_id,
            'province_id' => $city->province_id,
            'type' => $city->type,
            'name' => $city->name,
            'postal_code' => $city->postal_code,
        ]);
    }

    private function mockRajaongkirApi($provinceData = null, $cityData = null)
    {
        $fakeProvinceData = [
            'rajaongkir' => [
                'results' => $provinceData,
            ],
        ];

        $fakeCityData = [
            'rajaongkir' => [
                'results' => $cityData,
            ],
        ];

        // Mock RajaongkirRequestTrait methods
        $this->mockRajaongkirRequestTrait()
            ->shouldReceive('getRajaongkirData')
            ->with('province', ['id' => 1])
            ->andReturn($fakeProvinceData)
            ->shouldReceive('getRajaongkirData')
            ->with('city', ['id' => 1])
            ->andReturn($fakeCityData);
    }

    private function mockRajaongkirRequestTrait()
    {
        return $this->mock(RajaOngkirRequestTrait::class);
    }

    private function mockRajaongkirData($responseData)
    {
        // Mock the getRajaongkirData function to return the desired response
        Http::fake([
            'rajaongkir-api-url' => Http::response($responseData, 200),
        ]);
    }
}
