<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;


Route::get('/', HomeController::class)->name('home');

Route::get('about-us', [HomeController::class, 'about'])->name('about');

Route::prefix('account')->name('account.')->group(function () {
    Route::put('update-name/{user}', [AccountController::class, 'updateName'])->name('update-name');
    Route::put('update-phone/{user}', [AccountController::class, 'updatePhone'])->name('update-phone');
});
Route::get('account', [AccountController::class, 'index'])->name('account');

Route::prefix('orders')->name('orders.')->group(function () {
    Route::post('notification-handler', [OrderController::class, 'notification'])->name('notification');
    Route::get('confirmation', [OrderController::class, 'confirmation'])->name('confirmation');
    Route::get('payment-pending', [OrderController::class, 'pending'])->name('pending');
    Route::get('invoice/{order}', [OrderController::class, 'invoice'])->name('invoice');
});
Route::resource('orders', OrderController::class)->middleware(['DBTransaction']);

Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('{category:slug}', [ShopController::class, 'category'])->name('category');
    Route::get('{category:slug}/{product:slug}', [ShopController::class, 'product'])->name('product');
});
Route::get('shop', [ShopController::class, 'index'])->name('shop');

Route::prefix('addresses')->name('addresses.')->group(function () {
    Route::put('update-main/{address}', [AddressController::class, 'updateMain'])->name('update-main');
});
Route::resource('addresses', AddressController::class);

Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');

Route::resource('carts', CartController::class);


require __DIR__.'/auth.php';

