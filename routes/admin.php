<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShoeController;
use App\Http\Controllers\SizeController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;


Route::get('/', DashboardController::class)->name('dashboard');

Route::get('/manage-discount', [ShoeController::class, 'manageDiscount'])->name('shoes.manage-discount');
Route::put('/update-discount', [ShoeController::class, 'updateDiscount'])->name('shoes.update-discount');
Route::resource('shoes', ShoeController::class);

Route::prefix('orders')->name('orders.')->group(function () {
    Route::get('manage', [OrderController::class, 'manage'])->name('manage');
    Route::put('accept/{order}', [OrderController::class, 'accept'])->name('accept')->middleware('DBTransaction');
});

Route::resource('categories', CategoryController::class);

Route::resource('colors', ColorController::class);

Route::resource('sizes', SizeController::class);

Route::resource('roles', RoleController::class);

require __DIR__.'/auth.php';

