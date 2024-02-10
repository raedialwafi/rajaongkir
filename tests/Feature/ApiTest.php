<?php

// tests/Feature/ApiTest.php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\RajaongkirController;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_search_provinces()
    {
        $this->mock(RajaongkirController::class)
            ->shouldReceive('callAction')
            ->andReturnNull()
            ->shouldReceive('searchProvinces')
            ->shouldReceive('getMiddleware')
            ->andReturn([]);

        // Hit the API endpoint
        $response = $this->withBasicAuth(env('PARTNER_IN_AUTH_USERNAME'), env('PARTNER_IN_AUTH_PASSWORD'))
                         ->get('/api/search/provinces');

        // Assert HTTP status OK (200)
        $response->assertOk();
    }

    /** @test */
    public function it_can_search_cities()
    {
        // Mock hasil panggilan controller
        $this->mock(RajaongkirController::class)
            ->shouldReceive('callAction')
            ->andReturnNull()
            ->shouldReceive('searchCities')
            ->shouldReceive('getMiddleware')
            ->andReturn([]);

        // Hit the API endpoint
        $response = $this->withBasicAuth(env('PARTNER_IN_AUTH_USERNAME'), env('PARTNER_IN_AUTH_PASSWORD'))
                         ->get('/api/search/cities');

        // Assert HTTP status OK (200)
        $response->assertOk();
    }
}