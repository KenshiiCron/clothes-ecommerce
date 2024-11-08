<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

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
    Route::get('/products', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products.index');
    Route::resource('categories',\App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('products',\App\Http\Controllers\Admin\ProductController::class);
    Route::post('brands-update/{id}',[\App\Http\Controllers\Admin\BrandController::class, 'updatehh'])->name('brands.updatehh');
    Route::resource('brands',\App\Http\Controllers\Admin\BrandController::class);
    Route::resource('attribute-values',\App\Http\Controllers\Admin\AttributeValueController::class);
    Route::resource('attributes',\App\Http\Controllers\Admin\AttributeController::class);
    Route::resource('orders',\App\Http\Controllers\Admin\OrdersController::class);
});

require __DIR__.'/auth.php';
