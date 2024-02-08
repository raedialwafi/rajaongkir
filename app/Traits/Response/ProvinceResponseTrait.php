<?php

namespace App\Traits\Response;

trait ProvinceResponseTrait
{
    public function PublicProvinceResponse($province)
    {
        return [
            'id' => $province->id,
            'province_id' => $province->province_id,
            'name' => $province->name
        ];
    }
}
