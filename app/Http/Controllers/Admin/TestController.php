<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Kossa\AlgerianCities\Commune;

class TestController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $token = config('settings.zr_express_api_token');
        $key = config('settings.zr_express_api_key');

        $response = Http::withHeaders([
            'token' => $token,
            'key' => $key,
        ])->post('https://procolis.com/api_v1/tarification', [
            'test' => true
        ]);

        if ($response->successful()) {
            $wilayas = $response->json();
            $communes = Commune::all();;
            return Inertia::render('tests/index', compact('wilayas', 'communes'));
        }
        else {
            return response()->json("failed to retrieve data", ['response' => $response->json()]);
        }

    }

    public function test(Request $request)
    {
        $data = $request->validate([
            'wilaya' => 'required|integer',
            'delivery_type' => 'required|integer',
            'price' => 'required|integer',
            'commune' => 'required|string',
            'address' => 'sometimes|nullable|string',
        ]);

        $data['total'] = strval(1000 + intval($data['price']));

        $data['address'] = $data['address'] ?? $data['commune'];

//        dd($data);

        $token = config('settings.zr_express_api_token');
        $key = config('settings.zr_express_api_key');

        $response = Http::withHeaders([
            'token' => $token,
            'key' => $key,
        ])->post('https://procolis.com/api_v1/add_colis', [
            "Colis" => [
                [
                    "Tracking" => "",
                    "TypeLivraison" => $data['delivery_type'],             // Domicile : 0 & Stopdesk : 1
                    "TypeColis" => "0",                 // Normal : 0 & Echange : 1
                    "Confrimee" => "",                  // 1 pour les colis Confirmer directement en pret a expedier
                    "Client" => "Islem Belhadef",
                    "MobileA" => "0782389336",
                    "MobileB" => "0550422906",
                    "Adresse" => $data['address'],
                    "IDWilaya" => $data['wilaya'],
                    "Commune" => $data['commune'],
                    "Total" => $data['total'],
                    "Note" => "This is a note",
                    "TProduit" => "Test API ZR",
                    "id_Externe" => "",                 // Votre ID ou Tracking
                    "Source" => ""
                ]
            ]
        ]);

        if ($response->successful()) {
            $parcel = $response->json();
            $tracking = $parcel['Colis'][0]['Tracking'];
            dd($tracking);
        } else {
            return response()->json(['message' => 'Failed to add Colis', 'error' => $response->json()], $response->status());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('brands/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $data = $request->validated();
        $brand = $this->brand->new($data);
        return redirect()->route('admin.brands.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $brand = $this->brand->findOneById($id);
        return Inertia::render('brands/show',compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brand = $this->brand->findOneById($id);
        return Inertia::render('brands/edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        $brand = $this->brand->update($id, $request->validated());
        return redirect()->route('admin.brands.index');
    }

   /* public function updatehh(UpdateBrandRequest $request, $id)
    {
        dd($request->validated());
        $brand = $this->brand->update($id,$request->validated());
        return redirect()->route('admin.brands.index');
    }*/

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->brand->destroy($id);
        session()->flash('success',__('messages.flash.delete'));
        return redirect()->route('admin.brands.index');
    }
}
