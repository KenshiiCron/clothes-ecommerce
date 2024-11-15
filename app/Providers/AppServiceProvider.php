<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
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
                    $translations = $this->flattenArray($translations);  // Flatten the array
                }

                return $translations;
            },
            'locale' => App::getLocale(),

//            'errors' => session()->get('errors'),

            'toast' => function () {
                return session()->get('toast');
            },

        ]);
    }

    private function flattenArray($array, $prefix = '')
    {
        $result = [];

        foreach ($array as $key => $value) {
            $newKey = $prefix ? "$prefix.$key" : $key;

            if (is_array($value)) {
                $result += $this->flattenArray($value, $newKey);
            } else {
                $result[$newKey] = $value;
            }
        }

        return $result;
    }
}
