<?php

use Illuminate\Support\Facades\Route;



Route::post('locale', [\App\Http\Controllers\User\WebsiteController::class, 'switchLocale'])->name('switchLocale');


Route::get('/', [\App\Http\Controllers\User\WebsiteController::class, 'home'])->name('home');
Route::get('about', [\App\Http\Controllers\User\WebsiteController::class, 'about'])->name('about');
Route::get('/contact', [\App\Http\Controllers\User\WebsiteController::class, 'contact'])->name('contact');
Route::get('/shop', [\App\Http\Controllers\User\WebsiteController::class, 'shop'])->name('shop');

Route::resource('products', \App\Http\Controllers\User\ProductController::class);



require __DIR__.'/user/auth.php';
