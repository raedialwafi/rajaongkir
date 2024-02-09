<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;
use App\Console\Commands\FetchCities;
use App\Models\City;
use Illuminate\Support\Facades\Http;

class FetchCitiesTest extends TestCase
{
    /** @test */
    public function it_fetches_and_saves_cities_data()
    {
        // Mock the HTTP response from the RajaOngkir API
        Http::fake([
            config('services.rajaongkir.base_url') . 'city' => Http::response($this->fakeCitiesData(), 200),
        ]);

        // Run the FetchCities command
        $this->artisan('rajaongkir:fetch-cities')
             ->expectsOutput('Cities data fetched and saved successfully.');

        // Assert that the data has been saved in the database
        foreach ($this->fakeCitiesData()['rajaongkir']['results'] as $fakeCity) {
            $this->assertDatabaseHas('cities', [
                'city_id' => $fakeCity['city_id'],
                'province_id' => $fakeCity['province_id'],
                'type' => $fakeCity['type'],
                'name' => $fakeCity['city_name'],
                'postal_code' => $fakeCity['postal_code'],
            ]);
        }
    }

    public function it_handles_failure_to_fetch_cities_data()
    {
        // Mock the HTTP response from the RajaOngkir API with an error
        Http::fake([
            config('services.rajaongkir.base_url') . 'city' => Http::response([], 500),
        ]);

        // Run the FetchCities command
        $this->artisan('rajaongkir:fetch-cities')
             ->expectsOutput('Failed to fetch cities data from Rajaongkir API.');

        // Assert that the data has not been saved in the database
        $this->assertDatabaseMissing('cities', ['city_id' => 'mocked_city_id']);
    }

    private function fakeCitiesData()
    {
        return [
            'rajaongkir' => [
                'results' => [
                    [
                        'city_id' => "1",
                        'province_id' => "2",
                        'type' => 'kabupaten',
                        'city_name' => 'aceh besar',
                        'postal_code' => '23232',
                    ],
                    [
                        'city_id' => "2",
                        'province_id' => "2",
                        'type' => 'kabupaten',
                        'city_name' => 'aceh besar',
                        'postal_code' => '23231',
                    ]
                ],
            ],
        ];
    }
}
