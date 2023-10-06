<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShoeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TransactionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', HomeController::class)->name('home');
Route::get('dashboard', DashboardController::class)->name('dashboard');

Route::prefix('cart')->name('cart.')->group(function () {
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::delete('/remove[{key}', [CartController::class, 'remove'])->name('remove');
});
Route::get('cart', CartController::class)->name('cart');

Route::post('/transaction', [TransactionController::class, 'create'])->name('transaction.create')->middleware(['DBTransaction']);
Route::post('/transaction/notification-handler', [TransactionController::class, 'notification'])->name('transaction.notification')->middleware(['DBTransaction']);

Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('index');
    Route::get('/{category}', [ShopController::class, 'category'])->name('category');
    Route::get('/{category}/{shoe}', [ShopController::class, 'shoe'])->name('shoe');
});

Route::prefix('shoes')->name('shoes.')->group(function () {
    Route::post('/update-photo', [ShoeController::class, 'updatePhoto'])->name('update-photo');
});
Route::resource('shoes', ShoeController::class);

Route::resource('categories', CategoryController::class);

require __DIR__.'/auth.php';

