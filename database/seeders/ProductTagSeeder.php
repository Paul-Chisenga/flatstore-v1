<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $tags = Tag::take($products->count() * 2)->get(); // Get enough tags for products

        ProductTag::factory()
            ->count($products->count() * 2) // 2 tags per product
            ->sequence(
                fn($sequence) => [
                    'product_id' => $products->get($sequence->index % $products->count()),
                    'tag_id' => $tags->get($sequence->index % $tags->count()),
                ]
            )
            ->create();
    }
}
