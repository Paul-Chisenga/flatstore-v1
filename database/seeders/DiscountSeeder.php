<?php

namespace Database\Seeders;

use App\Models\Discount;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::take(10)->get(); // Take 10 products for seeding discounts
        Discount::factory()
            ->count($products->count())
            ->sequence(
                fn($sequence) => [
                    'product_id' => $products->get($sequence->index),
                ]
            )
            ->create();
    }
}
