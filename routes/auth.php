<?php

use App\Http\Controllers\Auth\User\AuthenticatedSessionController as UserAuthenticatedSessionController;
use App\Http\Controllers\Auth\Admin\AuthenticatedSessionController as AdminAuthenticatedSessionController;
use App\Http\Controllers\Auth\PhoneVerificationNotificationController;
use App\Http\Controllers\Auth\PhoneVerificationPromptController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyPhoneController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::domain(env('APP_URL'))->middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [UserAuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [UserAuthenticatedSessionController::class, 'authenticate']);
});

Route::domain('admin.' . env('APP_URL'))->middleware('guest')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AdminAuthenticatedSessionController::class, 'store']);
});

Route::domain(env('APP_URL'))->middleware('user.auth')->group(function () {
    Route::get('verify-phone', PhoneVerificationPromptController::class)
                ->name('verification-phone.notice');

    Route::post('verify-phone', VerifyPhoneController::class)
                ->middleware('throttle:6,1')
                ->name('verification-phone.verify');

    Route::get('phone/verification-notification', [PhoneVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification-phone.send');

    Route::post('logout', [UserAuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

Route::domain('admin.' . env('APP_URL'))->middleware('admin.auth')->name('admin.')->group(function () {
    Route::post('logout', [AdminAuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
});
