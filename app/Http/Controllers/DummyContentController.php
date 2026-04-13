<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class DummyContentController extends Controller
{
    public function __construct(private readonly Client $client = new Client([
        'base_uri' => 'https://dummyjson.com',
        'timeout' => 2.0,
    ])) {}

    public function categories()
    {

        try {
            $response = $this->client->get('/products/categories');
            $content = $response->getBody()->getContents();
            $categories = json_decode($content, true);
            dd($categories); // Dump the categories for testing purposes

            return back()->with('status', 'Categories fetched successfully');
        } catch (\Exception $e) {
            // Handle exceptions (e.g., network errors, API errors)
            return response()->json(['error' => 'Failed to fetch categories: '.$e->getMessage()], 500);
        }

    }

    public function products()
    {
        try {
            $response = $this->client->get('/products');
            $content = $response->getBody()->getContents();
            $products = json_decode($content, true);
            dd($products); // Dump the products for testing purposes

            return back()->with('status', 'Products fetched successfully');
        } catch (\Exception $e) {
            // Handle exceptions (e.g., network errors, API errors)
            return response()->json(['error' => 'Failed to fetch products: '.$e->getMessage()], 500);
        }
    }
}
