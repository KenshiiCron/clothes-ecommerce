<?php
namespace App\Services\Delivery;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class YalidineDeliveryService implements DeliveryServiceInterface
{
    /**
     * @throws ConnectionException
     */
    public function getShippingPrices()
    {
        $id = config('settings.yalidine_api_id');
        $token = config('settings.yalidine_api_token');

        $response = Http::withHeaders([
            "X-API-ID" => $id,
            "X-API-TOKEN" => $token,
        ])->get("https://api.yalidine.app/v1/deliveryfees");

        dd($response->json());
    }

    public function createShipment($order)
    {

    }

    public function trackShipment($trackingId)
    {

    }
}
