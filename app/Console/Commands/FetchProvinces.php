<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Province;
use App\Traits\Partners\RajaOngkir\RajaOngkirRequestTrait;
use DatabaseMigrations;

class FetchProvinces extends Command
{
    use RajaOngkirRequestTrait;

    protected $signature = 'rajaongkir:fetch-provinces';
    protected $description = 'Fetch and store provinces data from Rajaongkir API.';

    public function handle()
    {
        $provincesResponse = $this->getRajaOngkirData('province');

        if ($provincesResponse->successful()) {
            $provincesData = $provincesResponse->json()['rajaongkir']['results'];

            foreach ($provincesData as $provinceData) {
                Province::updateOrCreate(
                    ['province_id' => $provinceData['province_id']],
                    ['name' => $provinceData['province']]
                );
            }

            $this->info('Provinces data fetched and saved successfully.');
        } else {
            $this->error('Failed to fetch provinces data from Rajaongkir API.');
        }
    }
}
