<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\SubOrder;
use Illuminate\Database\Seeder;

class SubOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $order = Order::first();
        SubOrder::factory()
            ->count(2) // Create 2 sub-orders for the first order
            ->for($order)
            ->for($order->buyer->shippingAddresses()->first(), 'shippingAddress') // Associate with the buyer's first shipping address
            ->create();
    }
}
