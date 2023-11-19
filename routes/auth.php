<?php

use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\PhoneVerificationNotificationController;
use App\Http\Controllers\Auth\PhoneVerificationPromptController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\User\AuthenticatedSessionController;
use App\Http\Controllers\Auth\Admin\AuthenticatedSessionController as AdminAuthenticatedSessionController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\VerifyPhoneController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::domain('admin.' . env('APP_URL'))->name('admin.')->group(function () {
        Route::get('login', [AdminAuthenticatedSessionController::class, 'create'])
                    ->name('login');

        Route::post('login', [AdminAuthenticatedSessionController::class, 'store']);
    });
});

Route::middleware('user.auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-phone', PhoneVerificationPromptController::class)
                ->name('verification-phone.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('verify-phone', VerifyPhoneController::class)
                ->middleware('throttle:6,1')
                ->name('verification-phone.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('phone/verification-notification', [PhoneVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification-phone.send');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

Route::domain('admin.' . env('APP_URL'))->middleware('admin.auth')->name('admin.')->group(function () {
        Route::post('logout', [AdminAuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
