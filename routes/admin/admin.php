<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ProfileController;
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
    Route::resource('users',UserController::class);
    Route::resource('admins',AdminController::class);
    Route::resource('roles',RoleController::class);
    Route::resource('carousels',CarouselController::class);
    Route::resource('categories',CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('inventories',InventoryController::class);
    Route::put('products/attach/{id}',[ProductController::class,'attachAttribute'])->name('products.attach');
    Route::put('products/dettach/{id}',[ProductController::class,'dettachAttribute'])->name('products.dettach');
    Route::resource('brands',BrandController::class);
    Route::resource('products', ProductController::class);
    Route::post('products/images/{id}',[ProductController::class,'updateImages'])->name('products.images');
    Route::resource('attributes',AttributeController::class);
    Route::resource('attribute-values',AttributeValueController::class);
    Route::resource('orders',OrderController::class);
    Route::resource('carousels',CarouselController::class);
    Route::get('settings',[SettingController::class,'index'])->name('settings.index');
    Route::post('settings',[SettingController::class,'update'])->name('settings.update');


//    Test Routes
    Route::get('tests',[TestController::class,'index'])->name('tests.index');
    Route::post('tests/test',[TestController::class,'test'])->name('tests.test');
    Route::get('shipping', function () {
        $deliveryService = app()->make(\App\Services\Delivery\DeliveryServiceInterface::class, ['service' => 'yalidine']);
        $prices = $deliveryService->getShippingPrices();
        return response()->json($prices);
    });
});

require __DIR__.'/auth.php';
