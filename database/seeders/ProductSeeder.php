<?php

namespace Database\Seeders;

use App\Enums\SellerType;
use App\Models\Attachment;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductMedia;
use App\Models\ProductReview;
use App\Models\ProductVariation;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Seller;
use App\Models\Shop;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $seller = Seller::first();
        $category = Category::first();
        $brand = Brand::first();

        Product::factory(15)
            ->for($seller)
            ->for($category)
            ->for($brand)
            // Product with 3 variations, each variation has 2 media, each media has 1 attachment
            ->has(
                ProductVariation::factory()
                    ->count(3)
                    ->has(
                        ProductMedia::factory()
                            ->count(2)->has(
                                Attachment::factory(),
                                'media'
                            ),
                        'medias'
                    ),
                'variations'
            )
            // Product with 2 media, each media has 1 attachment
            ->has(
                ProductMedia::factory()
                    ->count(2)->has(
                        Attachment::factory(),
                        'media'
                    ),
                'medias'
            )
            ->has(
                Tag::factory()->count(3),
                'tags'
            )
            ->create();
    }
}
