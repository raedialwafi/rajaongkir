<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Response\CityResponseTrait;
use App\Traits\Response\ProvinceResponseTrait;
use App\Models\Province;
use App\Models\City;
use App\Traits\Partners\RajaOngkir\RajaOngkirRequestTrait;
use DatabaseMigrations;

class RajaongkirController extends Controller
{
    use ProvinceResponseTrait, CityResponseTrait, RajaOngkirRequestTrait;

    public function searchProvinces(Request $request)
    {
        $provinceId = $request->query('id');
        $province = $this->getData('province', $provinceId);

        return $this->handleProvinceResponse($province);
    }

    public function searchCities(Request $request)
    {
        $cityId = $request->query('id');
        $city = $this->getData('city', $cityId);

        return $this->handleCityResponse($city);
    }

    private function getData($type, $id)
    {
        return config('app.SWAPAPI_VALUE')
            ? $this->getRajaongkirData($type, ['id' => $id])
            : $this->getModelData($type, $id);
    }

    private function getModelData($type, $id)
    {
        return $type === 'province' ? Province::find($id) : City::find($id);
    }

    private function handleProvinceResponse($province)
    {
        if (!$province) {
            return response()->json(['message' => 'Province not found'], 404);
        }

        $response = $this->PublicProvinceResponse(
            config('app.SWAPAPI_VALUE') ? $province['rajaongkir']['results'] : $province
        );

        return response()->json($response);
    }

    private function handleCityResponse($city)
    {
        if (!$city) {
            return response()->json(['message' => 'City not found'], 404);
        }

        $response = $this->PublicCityResponse(
            config('app.SWAPAPI_VALUE') ? $city['rajaongkir']['results'] : $city
        );

        return response()->json($response);
    }
}
