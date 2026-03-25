<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Database\Seeder;

class ProductVariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        ProductVariation::factory()
            ->count($products->count() * 2) // Create 2 variations per product
            ->sequence(
                fn ($sequence) => ['product_id' => $products->get($sequence->index % $products->count())]
            )
            ->create();
    }
}
