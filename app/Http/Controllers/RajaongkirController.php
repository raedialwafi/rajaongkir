<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Response\CityResponseTrait;
use App\Traits\Response\ProvinceResponseTrait;
use App\Models\Province;
use App\Models\City;
use App\Traits\Partners\RajaOngkir\RajaOngkirRequestTrait;

class RajaongkirController extends Controller
{
    use ProvinceResponseTrait, CityResponseTrait, RajaOngkirRequestTrait;

    public function searchProvinces(Request $request)
    {
        if (config('app.SWAPAPI_VALUE')) {
            $provinceId = $request->query('id');
            $province = $this->getRajaongkirData('province', ['id' => $provinceId]);

            if (!$province) {
                return response()->json(['message' => 'Province not found'], 404);
            }

            $response = $this->PublicProvinceResponse(($province['rajaongkir']['results']));
        } else {
            $provinceId = $request->query('id');
            $province = Province::find($provinceId);

            if (!$province) {
                return response()->json(['message' => 'Province not found'], 404);
            }

            $response = $this->PublicProvinceResponse($province);
        }

        return response()->json($response);
    }

    public function searchCities(Request $request)
    {
        if (config('app.SWAPAPI_VALUE')) {
            $cityId = $request->query('id');
            $city = $this->getRajaongkirData('city', ['id' => $cityId]);

            if (!$city) {
                return response()->json(['message' => 'City not found'], 404);
            }

            $response = $this->PublicCityResponse($city['rajaongkir']['results']);
        } else {
            $cityId = $request->query('id');
            $city = City::find($cityId);

            if (!$city) {
                return response()->json(['message' => 'City not found'], 404);
            }

            $response = $this->PublicCityResponse($city);
        }

        return response()->json($response);
    }
}
