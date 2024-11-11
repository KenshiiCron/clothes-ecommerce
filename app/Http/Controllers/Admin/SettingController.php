<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Inertia::render('settings/index', [
            'settings' => config('settings')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $keys = $request->except('_token');
        foreach ($keys as $key => $value)
        {
            Setting::set($key, $value);
        }
        session()->flash("success","Réglages enregistrés avec succès");
        return redirect()->back();
    }

}
