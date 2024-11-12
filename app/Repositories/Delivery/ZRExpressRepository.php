<?php


namespace App\Repositories\Delivery;


use App\Contracts\DeliveryContract;
use App\Models\Delivery;
use App\Repositories\BaseRepositories;
use app\Traits\UploadAble;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;

class ZRExpressRepository extends BaseRepositories implements DeliveryContract
{
    use UploadAble;

    /**
     * @param Delivery $model
     * @param array $filters
     */
    #[Pure]
    public function __construct(Delivery $model, array $filters = [
        \App\QueryFilter\Search::class,
    ])
    {
        parent::__construct($model, $filters);
    }

    public function getParcels()
    {

    }

    public function getParcel($id)
    {

    }

    /**
     * @throws ConnectionException
     */
    public function createParcel($data)
    {
        $token = '';
        $key = '';

        $response = Http::withHeaders([
            'token' => $token,
            'key' => $key,
        ])->post('https://procolis.com/api_v1/add_colis', [
            "Colis" => [
                [
                    "Tracking" => "",
                    "TypeLivraison" => "0",             // Domicile : 0 & Stopdesk : 1
                    "TypeColis" => "0",                 // Normal : 0 & Echange : 1
                    "Confrimee" => "",                  // 1 pour les colis Confirmer directement en pret a expedier
                    "Client" => "Islem Belhadef",
                    "MobileA" => "0782389336",
                    "MobileB" => "0550422906",
                    "Adresse" => "UV 20 Ben Ouali",
                    "IDWilaya" => "25",
                    "Commune" => "El-Khroub",
                    "Total" => "2000",
                    "Note" => "This is a note",
                    "TProduit" => "Test API ZR",
                    "id_Externe" => "",                 // Votre ID ou Tracking
                    "Source" => ""
                ]
            ]
        ]);

        if ($response->successful()) {
            return response()->json(['message' => 'Colis added successfully', 'data' => $response->json()]);
        } else {
            return response()->json(['message' => 'Failed to add Colis', 'error' => $response->json()], $response->status());
        }
    }

    /**
     * @throws ConnectionException
     */
    public function getPricing()
    {
        $token = '';
        $key = '';

        $response = Http::withHeaders([
            'token' => $token,
            'key' => $key,
        ])->post('https://procolis.com/api_v1/tarification', [
            'test' => true
        ]);

    }
}
