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
        $province = Province::factory()->create();

        City::factory()->create(['province_id' => $province->province_id]);
        City::factory()->create(['province_id' => $province->province_id]);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $province->cities());

        $this->assertCount(2, $province->cities);
    }
}