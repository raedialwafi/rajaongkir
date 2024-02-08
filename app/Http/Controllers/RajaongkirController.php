<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Response\CityResponseTrait;
use App\Traits\Response\ProvinceResponseTrait;
use App\Models\Province;
use App\Models\City;

class RajaongkirController extends Controller
{
    use ProvinceResponseTrait, CityResponseTrait;

    public function searchProvinces(Request $request)
    {
        $provinceId = $request->query('id');
        $province = Province::find($provinceId);

        if (!$province) {
            return response()->json(['message' => 'Province not found'], 404);
        }

        $response = $this->PublicProvinceResponse($province);
        return response()->json($response);
    }

    public function searchCities(Request $request)
    {
        $cityId = $request->query('id');
        $city = City::find($cityId);

        if (!$city) {
            return response()->json(['message' => 'City not found'], 404);
        }

        $response = $this->PublicCityResponse($city);
        return response()->json($response);
    }
}
