<?php

namespace App\Traits\Response;

trait CityResponseTrait
{
    public function PublicCityResponse($city)
    {
        return [
            'id' => $city->id,
            'city_id' => $city->city_id,
            'name' => $city->name,
            'province_id' => $city->province_id,
            'type' => $city->type,
        ];
    }
}
