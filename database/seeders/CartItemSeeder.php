<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariation;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carts = Cart::all();
        $productVariations = ProductVariation::all();

        CartItem::factory()
            ->count($carts->count() * $productVariations->count())
            ->sequence(
                fn (Sequence $sequence) => [
                    'cart_id' => $carts->get($sequence->index % $carts->count()), // Loop through carts
                    'product_variation_id' => $productVariations->get($sequence->index % $productVariations->count()),
                ]
            )
            ->create();
    }
}
