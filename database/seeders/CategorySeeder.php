<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->createMany([
            [
                'name' => 'Clothing',
                'description' => 'Clothing, shoes, and accessories',
                'metadata' => ['ionicon_name' => 'shirt'],
            ],
            [
                'name' => 'Electronics',
                'description' => 'Electronic devices and gadgets',
                'metadata' => ['ionicon_name' => 'phone-portrait'],
            ],
            [
                'name' => 'Home',
                'description' => 'Furniture, Decor, Kitchenware, and more',
                'metadata' => ['ionicon_name' => 'home'],
            ],
            [
                'name' => 'Beauty',
                'description' => 'Beauty products and cosmetics',
                'metadata' => ['ionicon_name' => 'color-palette'],
            ],
            [
                'name' => 'Pets',
                'description' => 'Pet supplies and accessories',
                'metadata' => ['ionicon_name' => 'paw'],
            ],
            [
                'name' => 'Accessories',
                'description' => 'Fashion accessories and jewelry',
                'metadata' => ['ionicon_name' => 'watch'],
            ],
            [
                'name' => 'Food',
                'description' => 'Food and beverages',
                'metadata' => ['ionicon_name' => 'restaurant'],
            ],
            [
                'name' => 'Sports',
                'description' => 'Sporting goods and outdoor equipment',
                'metadata' => ['ionicon_name' => 'bicycle-outline'],
            ],
            [
                'name' => 'Books',
                'description' => 'Books and literature',
                'metadata' => ['ionicon_name' => 'book'],
            ],
        ]);
    }
}
