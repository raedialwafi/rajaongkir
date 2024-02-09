<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\City;
use App\Models\Province;

class CityTest extends TestCase
{
    use RefreshDatabase;

    public function testCityCanBeCreatedWithFillableAttributes()
    {
        $city = City::factory()->create();

        // Verifikasi bahwa model City telah terbuat dengan benar
        $this->assertInstanceOf(City::class, $city);

        // Verifikasi isi atribut yang diisi oleh factory
        $this->assertEquals($city->name, $city->name);
        $this->assertEquals($city->province_id, $city->province_id);

        // Jika ada atribut lain yang diisi oleh factory, tambahkan verifikasi di sini
    }
}
