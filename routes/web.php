<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index');
Route::get('demo', function () {
    // User
    $users = User::with('role')->with('profile')->get();

    // Brands
    $brands = Brand::with('products')->with('products.images')->get();

    // Categories
    $categories = Category::with('products')->get();

    return view("demo", ["users" => $users, "brands" => $brands, "categories" => $categories]);
});