<?php

namespace App\Traits\Partners\RajaOngkir;

use Illuminate\Support\Facades\Http;

trait RajaOngkirRequestTrait
{
    public function getRajaongkirData($endpoint, $params = [])
    {
        $url = config('services.rajaongkir.base_url') . $endpoint;

        // Check if there are parameters
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }

        return Http::withHeaders(['key' => config('services.rajaongkir.api_key')])
            ->get($url);
    }
}
