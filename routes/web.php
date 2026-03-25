<?php

use App\Http\Controllers\Auth\EmailVerificatonController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])
        ->name('products.index');
    Route::get('/{id}', [ProductController::class, 'show'])
        ->name('products.show');
});

Route::middleware('guest')->group(function () {
    // Login routes
    Route::get('/login', [LoginController::class, 'index'])
        ->name('login');
    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.post')
        ->middleware('throttle:login');
    // Registration routes
    Route::get('/register', [RegistrationController::class, 'index'])
        ->name('register');
    Route::post('/register', [RegistrationController::class, 'register'])
        ->name('register.post');
    // Password reset routes
    Route::get('/forgot-password', [PasswordResetController::class, 'forgotPassword'])
        ->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])
        ->name('password.email')
        ->middleware('throttle:forgot-password');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetPasswordForm'])
        ->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])
        ->name('password.store')
        ->middleware('throttle:reset-password');
});

Route::middleware('auth')->group(function () {
    // Email verification routes
    Route::get('/email/verify', [EmailVerificatonController::class, 'index'])
        ->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [EmailVerificatonController::class, 'verify'])
        ->name('verification.verify')
        ->middleware(['signed', 'throttle:6,1']); // limit to 6 attempts per minute
    Route::post('/email/resend', [EmailVerificatonController::class, 'resend'])
        ->name('verification.resend')
        ->middleware('throttle:6,1'); // limit to 6 attempts per minute

    // Other route
    Route::post('/logout', [LogoutController::class, 'logout'])
        ->name('logout');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/protected', function () {
        return view('app.protected');
    })->name('protected');
});
