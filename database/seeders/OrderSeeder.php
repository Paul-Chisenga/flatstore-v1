<?php

namespace Database\Seeders;

use App\Models\Buyer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory()
            ->for(Buyer::first(), 'buyer')
            ->has(
                OrderItem::factory()
                    ->for(ProductVariation::first(), 'productVariation'),
                'items'
            )
            ->create();
    }
}
