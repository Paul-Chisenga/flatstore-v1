<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $this->call([
                UserSeeder::class,
                ProfileSeeder::class,
                CategorySeeder::class,
                BrandSeeder::class,
                BuyerSeeder::class,
                SellerSeeder::class,
                ShopSeeder::class,
                ProductSeeder::class,
                ProductVariationSeeder::class,
                DiscountSeeder::class,
                ProductMediaSeeder::class,
                ProductReviewSeeder::class,
                CartSeeder::class,
                CartItemSeeder::class,
                ShippingAddressSeeder::class,
                PaymentMethodSeeder::class,
                OrderSeeder::class,
                SubOrderSeeder::class,
                OrderItemSeeder::class,
                    // ProductReviewSeeder::class
                TagSeeder::class,
                ProductTagSeeder::class,
                AttachmentSeeder::class,
            ]);
        });
    }
}
