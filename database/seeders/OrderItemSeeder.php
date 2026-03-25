<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $order = Order::first();
        $buyer = $order->buyer;
        $cart = Cart::where('buyer_id', $buyer->id)->with('items')->first();
        $sub_order = $order->subOrders()->first();
        $cart->items->each(function ($cartItem) use ($order, $sub_order) {
            $order->items()->create([
                'sub_order_id' => $sub_order->id, // Associate with the first sub-order for simplicity
                'product_variation_id' => $cartItem->product_variation_id,
                'quantity' => $cartItem->quantity,
                'unit_price' => $cartItem->unit_price,
                'tax_amount' => 0, // For simplicity, tax is set to 0
                'shipping_cost' => 5.00, // Flat shipping cost for demo
                'discount_value' => 0, // No discount for demo
            ]);
        });
    }
}
