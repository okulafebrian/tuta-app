<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\ShoeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', HomeController::class)->name('home');

Route::get('about-us', [HomeController::class, 'about'])->name('about');

Route::get('account', [AccountController::class, 'index'])->name('account');

Route::prefix('orders')->name('orders.')->group(function () {
    Route::post('notification-handler', [OrderController::class, 'notification'])->name('notification');
    Route::get('confirmation/{order:code}', [OrderController::class, 'confirmation'])->name('confirmation');
    Route::get('payment-pending', [OrderController::class, 'pending'])->name('pending');
    Route::get('test', [OrderController::class, 'test'])->name('test');
});
Route::resource('orders', OrderController::class)->middleware(['DBTransaction']);


Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('{category:slug}', [ShopController::class, 'category'])->name('category');
    Route::get('{category:slug}/{shoe:slug}', [ShopController::class, 'shoe'])->name('shoe');
});
Route::get('shop', [ShopController::class, 'index'])->name('shop');

Route::prefix('addresses')->name('addresses.')->group(function () {
    Route::put('set-main/{address}', [AddressController::class, 'setMain'])->name('set-main');
});
Route::resource('addresses', AddressController::class);

Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');

Route::resource('carts', CartController::class);

Route::resource('provinces', ProvinceController::class);

Route::resource('cities', CityController::class);


require __DIR__.'/auth.php';

