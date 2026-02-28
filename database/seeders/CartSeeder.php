<?php

namespace Database\Seeders;

use App\Models\Buyer;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariation;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buyers = Buyer::all();
        Cart::factory()
            ->count($buyers->count())
            ->sequence(
                fn(Sequence $sequence) => ['buyer_id' => $buyers->get($sequence->index)]
            )
            ->create();
    }
}
