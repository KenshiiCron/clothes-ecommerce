<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class WebsiteController extends Controller
{
    public function switchLocale(string $locale): \Illuminate\Http\RedirectResponse
    {
        if (! in_array($locale, ['en', 'fr', 'ar'])) {
            abort(400);
        }

        App::setLocale($locale);
        Session::put('locale', $locale);
        return redirect()->back();
    }
}
