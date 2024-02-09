<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;
use App\Console\Commands\FetchRajaOngkirData;
use Illuminate\Support\Facades\Artisan;

class FetchRajaOngkirDataTest extends TestCase
{
    /** @test */
    public function it_fetches_and_saves_rajaongkir_data()
    {
        // Run the FetchRajaOngkirData command
        Artisan::call('rajaongkir:fetch-data');

        // Get the output of the command
        $output = Artisan::output();

        // Assert that the expected output is present
        $this->assertStringContainsString('Provinces data fetched and saved successfully.', $output);
        $this->assertStringContainsString('Cities data fetched and saved successfully.', $output);
    }
}
