<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificatonController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\S3Controller;
use App\Http\Controllers\Seller\ProductController as SellerProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])
        ->name('products.index');
    Route::get('/{id}', [ProductController::class, 'show'])
        ->name('products.show');
});
Route::get('/download', [S3Controller::class, 'downloadFile'])
    ->name('download');

Route::middleware('guest')->group(function () {
    // Login routes
    Route::get('/login', [AuthController::class, 'index'])
        ->name('login');
    Route::post('/login', [AuthController::class, 'loginWeb'])
        ->name('login.post')
        ->middleware('throttle:login');
    // social login routes
    Route::get('/auth/google/redirect', [AuthController::class, 'googleRedirectWeb'])
        ->name('google.redirect');
    Route::get('/google/callback', [AuthController::class, 'googleLoginWeb'])
        ->name('google.callback');
    // Registration routes
    Route::get('/register', [RegistrationController::class, 'index'])
        ->name('register');
    Route::post('/register', [RegistrationController::class, 'registerWeb'])
        ->name('register.post');
    // Password reset routes
    Route::get('/forgot-password', [PasswordResetController::class, 'forgotPassword'])
        ->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkWeb'])
        ->name('password.email')
        ->middleware('throttle:forgot-password');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetPasswordForm'])
        ->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'resetPasswordWeb'])
        ->name('password.store')
        ->middleware('throttle:reset-password');

    /** Place holder content routes
     * Routes to fetch content from dummyjson.com for testing purposes. These routes can be removed once the actual content is integrated.
     */
    Route::prefix('/dummy-content')->group(function () {
        Route::get('/', function () {
            return view('app.dummy-content');
        })->name('dummy.content');
        Route::post('/categories', [\App\Http\Controllers\DummyContentController::class, 'categories'])
            ->name('dummy.categories');
        Route::post('/products', [\App\Http\Controllers\DummyContentController::class, 'products'])
            ->name('dummy.products');
    });

});

Route::middleware('auth')->group(function () {
    // Email verification routes
    Route::get('/email/verify', [EmailVerificatonController::class, 'index'])
        ->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [EmailVerificatonController::class, 'verifyWeb'])
        ->name('verification.verify')
        ->middleware(['signed', 'throttle:6,1']); // limit to 6 attempts per minute
    Route::post('/email/resend', [EmailVerificatonController::class, 'resendWeb'])
        ->name('verification.resend')
        ->middleware('throttle:6,1'); // limit to 6 attempts per minute

    // Other route
    Route::post('/logout', [AuthController::class, 'logoutWeb'])
        ->name('logout');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/protected', function () {
        return view('app.protected');
    })->name('protected');
});

// Admin routes (can be expanded with more specific admin functionalities)
Route::prefix('admin')
    ->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });
        Route::get('/dashboard', function () {
            return view('app.admin.index');
        })->name('admin.dashboard');
        // Brands
        Route::get('/brands', [BrandController::class, 'index'])
            ->name('admin.brands');
        Route::get('/brands/create', [BrandController::class, 'create'])
            ->name('admin.brands.create');
        Route::post('/brands', [BrandController::class, 'store'])
            ->name('admin.brands.store');
        Route::get('/brands/{brand}', [BrandController::class, 'show'])
            ->name('admin.brands.show');
        Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])
            ->name('admin.brands.edit');
        Route::put('/brands/{brand}', [BrandController::class, 'update'])
            ->name('admin.brands.update');
        Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])
            ->name('admin.brands.destroy');
        // Categories
        Route::get('/categories', [CategoryController::class, 'index'])
            ->name('admin.categories');
        Route::get('/categories/create', [CategoryController::class, 'create'])
            ->name('admin.categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])
            ->name('admin.categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
            ->name('admin.categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])
            ->name('admin.categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
            ->name('admin.categories.destroy');
        Route::get('/categories/{parentCategory}/create-child', [CategoryController::class, 'createChild'])
            ->name('admin.categories.create-child');
        Route::post('/categories/{parentCategory}/create-child', [CategoryController::class, 'storeChild'])
            ->name('admin.categories.store-child');
        // Sellers
        Route::get('/sellers', [SellerController::class, 'index'])
            ->name('admin.sellers');
        Route::get('/sellers/create', [SellerController::class, 'create'])
            ->name('admin.sellers.create');
        Route::post('/sellers', [SellerController::class, 'store'])
            ->name('admin.sellers.store');
        Route::get('/sellers/{id}', [SellerController::class, 'show'])
            ->name('admin.sellers.show');
        Route::get('/sellers/{id}/edit', [SellerController::class, 'edit'])
            ->name('admin.sellers.edit');
        Route::put('/sellers/{id}', [SellerController::class, 'update'])
            ->name('admin.sellers.update');
        Route::delete('/sellers/{id}', [SellerController::class, 'destroy'])
            ->name('admin.sellers.destroy');
        // Stores
        Route::get('/stores', [StoreController::class, 'index'])
            ->name('admin.stores');
        Route::get('/stores/create', [StoreController::class, 'create'])
            ->name('admin.stores.create');
        Route::post('/stores', [StoreController::class, 'store'])
            ->name('admin.stores.store');
        Route::get('/stores/{store}', [StoreController::class, 'show'])
            ->name('admin.stores.show');
        Route::get('/stores/{store}/edit', [StoreController::class, 'edit'])
            ->name('admin.stores.edit');
        Route::put('/stores/{store}', [StoreController::class, 'update'])
            ->name('admin.stores.update');
        Route::delete('/stores/{store}', [StoreController::class, 'destroy'])
            ->name('admin.stores.destroy');
        // Products
        Route::get('/products', [\App\Http\Controllers\Admin\ProductController::class, 'index'])
            ->name('admin.products');
        Route::get('/products/create', [\App\Http\Controllers\Admin\ProductController::class, 'create'])
            ->name('admin.products.create');
        Route::post('/products', [\App\Http\Controllers\Admin\ProductController::class, 'store'])
            ->name('admin.products.store');
        Route::get('/products/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'show'])
            ->name('admin.products.show');
        Route::get('/products/{product}/edit', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])
            ->name('admin.products.edit');
        Route::put('/products/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])
            ->name('admin.products.update');
        Route::delete('/products/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'destroy'])
            ->name('admin.products.destroy');
    });

// Seller routes (can be expanded with more specific seller functionalities)
Route::prefix('seller')
    ->group(function () {
        Route::get('/', function () {
            return redirect()->route('seller.dashboard');
        });
        Route::get('/dashboard', function () {
            return view('app.seller.index');
        })->name('seller.dashboard');
        // Products
        Route::get('/products', [SellerProductController::class, 'index'])
            ->name('seller.products');
        Route::get('/products/create', [SellerProductController::class, 'create'])
            ->name('seller.products.create');
        Route::post('/products', [SellerProductController::class, 'store'])
            ->name('seller.products.store');
        Route::get('/products/{id}', [SellerProductController::class, 'show'])
            ->name('seller.products.show');
        Route::get('/products/{id}/edit', [SellerProductController::class, 'edit'])
            ->name('seller.products.edit');
    });
