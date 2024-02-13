<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\City;
use App\Traits\Partners\RajaOngkir\RajaOngkirRequestTrait;
use DatabaseMigrations;

class FetchCities extends Command
{
    use RajaOngkirRequestTrait;

    protected $signature = 'rajaongkir:fetch-cities';
    protected $description = 'Fetch and store cities data from Rajaongkir API.';

    public function handle()
    {
        $citiesResponse = $this->getRajaOngkirData('city');

        if ($citiesResponse->successful()) {
            $citiesData = $citiesResponse->json()['rajaongkir']['results'];

            foreach ($citiesData as $cityData) {
                City::updateOrCreate(
                    ['city_id' => $cityData['city_id']],
                    [
                        'province_id' => $cityData['province_id'],
                        'type' => $cityData['type'],
                        'name' => $cityData['city_name'],
                        'postal_code' => $cityData['postal_code'],
                    ]
                );
            }

            $this->info('Cities data fetched and saved successfully.');
        } else {
            $this->error('Failed to fetch cities data from Rajaongkir API.');
        }
    }
}
