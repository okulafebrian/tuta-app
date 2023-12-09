<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\SizeController;
use Illuminate\Support\Facades\Route;


Route::get('/', DashboardController::class)->name('dashboard');

Route::get('/manage-discount', [ProductController::class, 'manageDiscount'])->name('products.manage-discount');
Route::put('/update-discount', [ProductController::class, 'updateDiscount'])->name('products.update-discount');
Route::resource('products', ProductController::class);

Route::get('orders/manage', [OrderController::class, 'manage'])->name('orders.manage');
Route::put('orders/cancel/{order}', [OrderController::class, 'cancel'])->name('orders.cancel');

Route::prefix('shipping')->name('shipping.')->group(function () {
    Route::get('receipt/{shipping}', [ShippingController::class, 'receipt'])->name('receipt');
    Route::get('{shipping}', [ShippingController::class, 'show'])->name('show');
    Route::post('/', [ShippingController::class, 'store'])->name('store');
});

Route::resource('categories', CategoryController::class);

Route::resource('collections', CollectionController::class);

Route::resource('colors', ColorController::class);

Route::resource('sizes', SizeController::class);

require __DIR__.'/auth.php';

