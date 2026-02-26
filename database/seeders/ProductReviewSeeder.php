<?php

namespace Database\Seeders;

use App\Models\Buyer;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductReview::factory()
            ->count(3)
            ->for(Product::first(), 'product')
            ->for(Buyer::first(), 'buyer')
            ->create();
    }
}
