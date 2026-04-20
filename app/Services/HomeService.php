<?php

namespace App\Services;

use App\Dtos\Home\CategoryDTO;
use App\Dtos\Home\ProductDTO;
use App\Models\Category;
use App\Models\Product;
use App\Models\RecentViewedProduct;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomeService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getCategories(): array
    {
        $categories = Category::limit(8)->select('id', 'name', 'metadata')->get();

        return $categories->map(fn (Category $category) => new CategoryDTO(
            id: $category->id,
            name: $category->name,
            icon: $category->metadata['ionicon_name']
        ))->toArray();
    }

    public function getFeaturedProducts(): array
    {
        // For simplicity, we are just fetching the latest products. In a real application,
        // you might want to have a more complex logic to determine featured products.
        $products = Product::with(['variations' => fn (HasMany $query) => $query->where('is_default', true)->select('id', 'product_id', 'price')])
            ->latest()
            ->limit(12)
            ->get()
            ->toArray();

        return array_map(fn ($product) => new ProductDTO(
            id: $product['id'],
            name: $product['name'],
            price: $product['variations'][0]['price'] ?? 0, // Assuming
            // rating: $product['reviews_count'] > 0 ? $product['reviews_avg_rating'] : 0, // Assuming you have reviews relationship with avg_rating and count
            rating: 7, // Placeholder for rating, replace with actual logic
            image: route('download', ['file_path' => $product['thumbnail_path']])
        ), $products);
    }

    public function getRecentlyViewedProducts(string $user_id): array
    {
        $recentlyViewedProducts = RecentViewedProduct::with('product')
            ->where('user_id', $user_id)
            ->latest()
            ->limit(12)
            ->get();

        return $recentlyViewedProducts->map(fn (RecentViewedProduct $recentlyViewedProduct) => new ProductDTO(
            id: $recentlyViewedProduct->product->id,
            name: $recentlyViewedProduct->product->name,
            price: $recentlyViewedProduct->product->variations->first()?->price ?? 0,
            rating: 7, // Placeholder for rating, replace with actual logic
            image: route('download', ['file_path' => $recentlyViewedProduct->product->thumbnail_path])
        ))->toArray();

    }
}
