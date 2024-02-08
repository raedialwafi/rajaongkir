<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FetchRajaOngkirData extends Command
{
    protected $signature = 'rajaongkir:fetch-data';
    protected $description = 'Fetch data provinces and cities from Rajaongkir API and store it in the database.';

    public function handle()
    {
        // Fetch Provinces
        $this->call('rajaongkir:fetch-provinces');

        // Fetch Cities
        $this->call('rajaongkir:fetch-cities');
    }
}
