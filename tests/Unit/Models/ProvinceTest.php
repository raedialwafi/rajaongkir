<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Province;
use App\Models\City;

class ProvinceTest extends TestCase
{
    use RefreshDatabase;

    public function testProvinceHasManyCitiesRelationship()
    {
        // Create a Province instance
        $province = Province::factory()->create();

        // Create two City instances associated with the province
        City::factory()->create(['province_id' => $province->province_id]);
        City::factory()->create(['province_id' => $province->province_id]);

        // Assert that the relationship exists
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $province->cities());

        // Assert that the number of associated cities matches the expected count
        $this->assertCount(2, $province->cities);
    }
}