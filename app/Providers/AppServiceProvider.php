<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Inertia::share([
            'translations' => function () {
                $locale = App::getLocale();
                $translations = [];
                $langPath = lang_path("$locale.json");

                if (File::exists($langPath)) {
                    $translations = json_decode(File::get($langPath), true);
                }

                return $translations;
            },
            'locale' => App::getLocale(),
        ]);
    }
}
