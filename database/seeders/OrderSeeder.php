<?php

namespace Database\Seeders;

use App\Models\Buyer;
use App\Models\Order;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buyers = Buyer::all();
        Order::factory()
            ->count($buyers->count())
            ->sequence(
                fn ($sequence) => [
                    'buyer_id' => $buyers->get($sequence->index),
                    'payment_method_id' => PaymentMethod::inRandomOrder()->first(),
                ]
            )
            ->create();
    }
}
