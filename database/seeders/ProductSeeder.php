<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $sellers = Seller::all();
        $categories = Category::all();
        $brands = Brand::all();

        Product::factory()
            ->count(50)
            ->sequence(
                fn ($sequence) => [
                    'seller_id' => $sellers->get($sequence->index % $sellers->count()),
                    'category_id' => $categories->get($sequence->index % $categories->count()),
                    'brand_id' => $brands->get($sequence->index % $brands->count()),
                ]
            )
            ->create();
    }
}
