<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificatonController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegistrationController;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::post('/login', [AuthController::class, 'loginApi'])
    ->middleware('throttle:login');
Route::get('/google', [AuthController::class, 'googleRedirectApi']);
Route::get('/google/callback', [AuthController::class, 'googleLoginApi']);
// Registration route
Route::post('/register', [RegistrationController::class, 'registerApi']);

// special route - only used to redirect to the app and trigger the email verification in the app
Route::get('/email/verify/redirect/{id}/{hash}', [EmailVerificatonController::class, 'verifyApiRedirect'])
    ->middleware('signed')
    ->name('verification.verify.api');

// Password reset routes
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkApi'])
    ->middleware('throttle:forgot-password');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetPasswordFormApi'])
    ->name('password.reset.api');
Route::post('/reset-password', [PasswordResetController::class, 'resetPasswordApi'])
    ->middleware('throttle:reset-password');

// Protected routes that do not require email verification
Route::middleware('auth:sanctum')->group(function () {
    // Email verification routes
    Route::post('/email/verify/{id}/{hash}', [EmailVerificatonController::class, 'verifyApi']);
    // ->middleware(['signed', 'throttle:6,1']); // limit to 6 attempts per minute
    Route::post('/email/resend', [EmailVerificatonController::class, 'resendApi'])
        ->name('verification.resend.api')
        ->middleware('throttle:6,1'); // limit to 6 attempts per minute

    // Other route
    Route::delete('/logout', [AuthController::class, 'logoutApi']);
});
