<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // for products
        $products = Product::all();
        Tag::factory()
            ->count($products->count() * 2) // 2 tags per product
            ->create();
    }
}
