<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.seller.products.index', [
            'products' => [
                (object) [
                    'id' => 1,
                    'name' => 'Product 1',
                    'description' => 'This is the description for Product 1.',
                    'price' => 19.99,
                    'image_url' => 'https://cdn.dummyjson.com/product-images/beauty/essence-mascara-lash-princess/thumbnail.webp',
                ],
                (object) [
                    'id' => 2,
                    'name' => 'Product 2',
                    'description' => 'This is the description for Product 2.',
                    'price' => 29.99,
                    'image_url' => 'https://cdn.dummyjson.com/product-images/beauty/eyeshadow-palette-with-mirror/thumbnail.webp',
                ],
                (object) [
                    'id' => 3,
                    'name' => 'Product 3',
                    'description' => null,
                    'price' => 39.99,
                    'image_url' => 'https://cdn.dummyjson.com/product-images/beauty/powder-canister/thumbnail.webp',
                ],
                (object) [
                    'id' => 4,
                    'name' => 'Product 4',
                    'description' => null,
                    'price' => 49.99,
                    'image_url' => 'https://cdn.dummyjson.com/product-images/smartphones/iphone-5s/thumbnail.webp',
                ],
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.seller.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
