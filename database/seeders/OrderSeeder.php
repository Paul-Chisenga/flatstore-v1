<?php

namespace Database\Seeders;

use App\Models\Buyer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariation;
use App\Models\Seller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seller = Seller::first();
        Order::factory()
            ->for(Buyer::first())
            ->for($seller)
            ->for($seller->shops()->first())
            ->has(
                OrderItem::factory()
                    ->for(ProductVariation::first(), 'productVariation'),
                'items'
            )
            ->create();
    }
}
