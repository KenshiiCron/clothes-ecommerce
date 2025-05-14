<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
            then: function () {
            \Illuminate\Support\Facades\Route::middleware('admin')->prefix('admin')->name('admin.')->group(__DIR__ . '/../routes/admin/admin.php');
            \Illuminate\Support\Facades\Route::middleware('web')->group(__DIR__ . '/../routes/web.php');
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\LocalizationMiddleware::class,
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);
        $middleware->redirectGuestsTo(function (\Illuminate\Http\Request $request) {
            if ($request->is('admin*')) {
                return route('admin.login');
            }
            return route('login');
        });


        $middleware->alias([
            'guest' => \App\Http\Middleware\OnlyGuestAllowedMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
