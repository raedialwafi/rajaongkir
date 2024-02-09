<?php

namespace Tests\Unit\Traits\Partners\RajaOngkir;

use App\Traits\Partners\RajaOngkir\RajaOngkirRequestTrait;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class RajaOngkirRequestTraitTest extends TestCase
{
    use RajaOngkirRequestTrait;

    /** @test */
    public function it_can_get_rajaongkir_data()
    {
        // Mock the Http facade
        Http::fake([
            '*' => Http::response(['data' => 'fake_data'], 200),
        ]);

        // Test fetching data
        $responseData = $this->getRajaongkirData('/endpoint', ['param' => 'value']);

        // Assert that the expected request was sent
        Http::assertSent(function ($request) {
            return true;
        });

        // Assert the response data
        $this->assertEquals(['data' => 'fake_data'], $responseData->json());
    }
}
