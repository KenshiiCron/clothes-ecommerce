<?php

namespace App\Http\Controllers\User;

use App\Enums\Carousel\State;
use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class WebsiteController extends Controller
{
    public function switchLocale(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate(['locale' => ['required', 'string', 'in:en,fr,ar']]);

        if (!in_array($data['locale'], ['en', 'fr', 'ar'])) {
            abort(400);
        }


        App::setLocale($data['locale']);
        Session::put('locale', $data['locale']);

        return redirect()->back();
    }

    public function home()
    {
        $carousels = Carousel::active()->get();
        $categories = Category::featured()->select('id', 'name', 'slug', 'image')->get();
        $featuredProducts = Product::active()->featured()->select('id', 'name', 'image')->get();
        return view('pages.home', compact('carousels', 'categories', 'featuredProducts'));
    }

    public function shop()
    {

    }

    public function about()
    {

    }

    public function contact()
    {

    }
}
