<?php

namespace App\Services;

use App\Dtos\Product\ProductItemDTO;
use App\Models\Product;

class ProductService
{
    public function searchProducts(string $query): array
    {
        $products = Product::query()
            ->whereLike('name', "%{$query}%")
            ->orWhereLike('description', "%{$query}%")
            ->orWhereHas('categories', fn ($q) => $q->whereLike('name', "%{$query}%"))
            ->orWhereHas('brand', fn ($q) => $q->whereLike('name', "%{$query}%"))
            ->orWhereHas('seller', fn ($q) => $q->whereLike('name', "%{$query}%"))
            ->with(['variations' => fn ($q) => $q->where('is_default', true)->select('id', 'product_id', 'price')])
            ->latest()
            ->limit(20)
            ->get();

        $final_products = $products->map(fn (Product $product) => new ProductItemDTO(
            id: $product->id,
            name: $product->name,
            price: $product->variations->first()->price ?? 0,
            rating: 0, // Placeholder for rating, replace with actual logic
            image: route('download', ['file_path' => $product->thumbnail_path])
        ))->toArray();

        return $final_products;
    }
}
