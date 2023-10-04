<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShoeController;
use App\Http\Controllers\ShopController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', HomeController::class)->name('home');
Route::get('/dashboard', DashboardController::class)->name('dashboard');


Route::prefix('/shop')->name('shop.')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('index');
    Route::get('/{category}', [ShopController::class, 'category'])->name('category');
    Route::get('/{category}/{shoe}', [ShopController::class, 'shoe'])->name('shoe');
});

Route::resource('shoes', ShoeController::class);
Route::resource('categories', CategoryController::class);

require __DIR__.'/auth.php';

