<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;
use App\Console\Commands\FetchProvinces;
use App\Models\Province;
use Illuminate\Support\Facades\Http;

class FetchProvincesTest extends TestCase
{
    /** @test */
    public function it_fetches_and_saves_provinces_data()
    {
        // Mock the HTTP response from the RajaOngkir API
        Http::fake([
            config('services.rajaongkir.base_url') . 'province' => Http::response($this->fakeProvincesData(), 200),
        ]);

        // Run the FetchProvinces command
        $this->artisan('rajaongkir:fetch-provinces')
             ->expectsOutput('Provinces data fetched and saved successfully.');

        // Assert that the data has been saved in the database
        $this->assertDatabaseHas('provinces', [
            'province_id' => '5',
            'name' => 'DI Yogyakarta',
        ]);
    }

    /** @test */
    public function it_handles_failure_to_fetch_provinces_data()
    {
        // Mock the HTTP response from the RajaOngkir API with an error
        Http::fake([
            config('services.rajaongkir.base_url') . 'province' => Http::response([], 500),
        ]);

        // Run the FetchProvinces command
        $this->artisan('rajaongkir:fetch-provinces')
             ->expectsOutput('Failed to fetch provinces data from Rajaongkir API.');

        // Assert that the data has not been saved in the database
        $this->assertDatabaseMissing('provinces', ['province_id' => 'mocked_province_id']);
    }

    private function fakeProvincesData()
    {
        return [
            'rajaongkir' => [
                'results' => [
                    [
                        'province_id' => '5',
                        'province' => 'DI Yogyakarta',
                    ],
                    [
                        'province_id' => '6',
                        'province' => 'Bali',
                    ]
                ],
            ],
        ];
    }
}
