<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ZRExpressPrices extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'wilaya_id' => $this['IDWilaya'],
            'wilaya_name' => $this['Wilaya'],
            'home_fee' => $this['Domicile'],
            'desk_fee' => $this['Stopdesk'],
            'cancel_fee' => $this['Annuler'],
        ];
    }
}
