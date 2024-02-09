<?php

namespace Tests\Unit\Traits\Response;

use App\Traits\Response\ProvinceResponseTrait;
use Tests\TestCase;

class ProvinceResponseTraitTest extends TestCase
{
    use ProvinceResponseTrait;

    /** @test */
    public function it_can_generate_province_response()
    {
        // Mock province data
        $provinceData = [
            'province_id' => 123,
            'province' => 'Test Province',
        ];

        // Generate response using the trait method
        $response = $this->PublicProvinceResponse($provinceData);

        // Assert the response structure and values
        $this->assertEquals([
            'id' => 123,
            'province_id' => 123,
            'name' => 'Test Province',
        ], $response);
    }
}
