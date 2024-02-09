<?php

namespace App\Traits\Response;

trait CityResponseTrait
{
    public function PublicCityResponse($city)
    {

        return [
            'id' => $city->id ?? $city->city_id ?? $city['city_id'],
            'city_id' => $city->city_id ?? $city['city_id'],
            'name' => $city->name ?? $city['city_name'],
            'province_id' => $city->province_id ?? $city['province_id'],
            'type' => $city->type ?? $city['type'],
            'postal_code' => $city->postal_code ?? $city['postal_code'],
        ];
    }
}
