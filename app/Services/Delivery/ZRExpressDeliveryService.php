<?php
namespace App\Services\Delivery;

use App\Http\Resources\ZRExpressPrices;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class ZRExpressDeliveryService implements DeliveryServiceInterface
{
    /**
     * @throws ConnectionException
     */
    public function getShippingPrices()
    {
        $token = config('settings.zr_express_api_token');
        $key = config('settings.zr_express_api_key');

        $response = Http::withHeaders([
            'token' => $token,
            'key' => $key,
        ])->post('https://procolis.com/api_v1/tarification', [
            'test' => true
        ]);
//        dd($response->json());
        return ZRExpressPrices::collection($response->json());
    }

    public function createShipment($order)
    {

    }

    public function trackShipment($trackingId)
    {

    }
}
