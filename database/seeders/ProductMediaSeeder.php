<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductMedia;
use App\Models\ProductVariation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $productVariations = ProductVariation::all();

        // Create media for products
        ProductMedia::factory()
            ->count($products->count() * 1) // 3 media items per product
            ->sequence(
                fn($sequence) => ['product_id' => $products->get($sequence->index % $products->count())]
            )
            ->create();

        // Create media for product variations
        ProductMedia::factory()
            ->count($productVariations->count() * 1) // 1 media item
            ->sequence(
                fn($sequence) => [
                    'product_id' => $productVariations->get($sequence->index % $productVariations->count())->product_id, // Associate with the parent product
                    'product_variation_id' => $productVariations->get($sequence->index % $productVariations->count())
                ]
            )
            ->create();
    }
}
