<?php

namespace Database\Seeders;

use App\Enums\SellerType;
use App\Models\Attachment;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Seller;
use App\Models\Shop;
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
        DB::transaction(function () {
            $user = User::factory()
                ->has(Role::factory(), 'role')
                ->has(
                    Profile::factory()->has(Attachment::factory(), 'profilePhoto'),
                    'profile'
                )
                ->create();

            $seller = Seller::factory()
                ->state(["type" => SellerType::Shop->value])
                ->for($user)
                ->has(Shop::factory(), 'shops')
                ->create();

            $category = Category::factory()->create();
            $brand = Brand::factory()->create();

            Product::factory(15)
                ->for($seller)
                ->for($category)
                ->for($brand)
                ->has(Attachment::factory(6), 'images')
                ->create();
        });
    }
}
