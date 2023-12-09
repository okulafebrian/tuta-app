<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\ZipCodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('provinces', [ProvinceController::class, 'load'])->name('provinces.load');
Route::get('cities/{provinceId}', [CityController::class, 'load'])->name('cities.load');
Route::get('districts/{cityId}', [DistrictController::class, 'load'])->name('districts.load');
Route::get('zip-codes/{districtId}', [ZipCodeController::class, 'load'])->name('zip-codes.load');




Route::get('tariff-check', [ShippingController::class, 'tariffCheck'])->name('tariff-check');
