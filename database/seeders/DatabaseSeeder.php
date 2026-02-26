<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            BrandSeeder::class,
            SellerSeeder::class,
            BuyerSeeder::class,
            ProductSeeder::class,
            CartSeeder::class,
            OrderSeeder::class,
            ProductReviewSeeder::class
        ]);
    }
}
