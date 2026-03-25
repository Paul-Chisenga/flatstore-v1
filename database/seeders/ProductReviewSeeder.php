<?php

namespace Database\Seeders;

use App\Models\Buyer;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Database\Seeder;

class ProductReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $buyer = Buyer::all();
        $products = Product::all();

        ProductReview::factory()
            ->count(3)
            ->sequence(
                fn ($sequence) => [
                    'product_id' => $products->get($sequence->index % $products->count()),
                    'buyer_id' => $buyer->get($sequence->index % $buyer->count()),
                ]
            )
            ->create();
    }
}
