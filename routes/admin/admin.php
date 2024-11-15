<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::permanentRedirect('/','/admin/dashboard');

Route::get('/dashboard', function () {
    return Inertia::render('dashboard');
})->middleware(['auth:admin', 'verified'])->name('dashboard');

Route::middleware(['auth:admin', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth:admin', 'verified'])->group(function () {
    Route::resource('users',\App\Http\Controllers\Admin\UserController::class);
    Route::resource('admins',\App\Http\Controllers\Admin\AdminController::class);
    Route::resource('roles',\App\Http\Controllers\Admin\RoleController::class);
    Route::resource('carousels',\App\Http\Controllers\Admin\CarouselController::class);
    Route::resource('categories',\App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('products',\App\Http\Controllers\Admin\ProductController::class);
    Route::resource('inventories',\App\Http\Controllers\Admin\InventoryController::class);
    Route::put('products/attach/{id}',[\App\Http\Controllers\Admin\ProductController::class,'attachAttribute'])->name('products.attach');
    Route::put('products/dettach/{id}',[\App\Http\Controllers\Admin\ProductController::class,'dettachAttribute'])->name('products.dettach');
    Route::post('products/import',[\App\Http\Controllers\Admin\ProductController::class,'importProducts'])->name('products.import');
    Route::get('products/export',[\App\Http\Controllers\Admin\ProductController::class,'exportsProducts'])->name('products.export');
    Route::resource('brands',\App\Http\Controllers\Admin\BrandController::class);
    Route::resource('products',\App\Http\Controllers\Admin\ProductController::class);
    Route::resource('attributes',\App\Http\Controllers\Admin\AttributeController::class);
    Route::resource('attribute-values',\App\Http\Controllers\Admin\AttributeValueController::class);
    Route::resource('orders',\App\Http\Controllers\Admin\OrderController::class);
    Route::resource('carousels',\App\Http\Controllers\Admin\CarouselController::class);
    Route::get('settings',[App\Http\Controllers\Admin\SettingController::class,'index'])->name('settings.index');
    Route::post('settings',[App\Http\Controllers\Admin\SettingController::class,'update'])->name('settings.update');


//    Test Routes
    Route::get('tests',[App\Http\Controllers\Admin\TestController::class,'index'])->name('tests.index');
    Route::post('tests/test',[App\Http\Controllers\Admin\TestController::class,'test'])->name('tests.test');
    Route::get('shipping', function () {
        $deliveryService = app()->make(\App\Services\Delivery\DeliveryServiceInterface::class, ['service' => 'yalidine']);
        $prices = $deliveryService->getShippingPrices();
        return response()->json($prices);
    });
});

require __DIR__.'/auth.php';
