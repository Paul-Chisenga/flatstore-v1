<?php

namespace Database\Seeders;

use App\Models\Buyer;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariation;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cart::factory()
            ->for(Buyer::first(), 'buyer')
            ->has(
                CartItem::factory()
                    ->for(ProductVariation::first(), 'productVariation'),
                'items'
            )
            ->create();
    }
}
