<?php

namespace App\Http\Controllers;

use App\Services\HomeService;

class HomeController extends Controller
{
    public function __construct(private HomeService $homeService) {}

    // For the web return all the sections in one request
    public function index()
    {
        return view('app.index', [
            'popular_products' => [],
            'related_products' => [],
            'recent_products' => [],
        ]);
    }

    public function specialOffers() {}

    public function categories()
    {
        try {
            $categories = $this->homeService->getCategories();

            return response()->json($categories);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch categories'], 500);
        }
    }

    public function featuredProducts()
    {
        try {
            $products = $this->homeService->getFeaturedProducts();

            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch featured products'], 500);
        }
    }

    public function recentViews()
    {
        try {
            $user_id = auth()->id();
            $products = $this->homeService->getRecentlyViewedProducts($user_id);

            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch recently viewed products'], 500);
        }
    }

    public function popularFilters() {}

    public function popularProducts() {}

    public function featuredShops() {}

    public function recommendedForYou() {}
}
