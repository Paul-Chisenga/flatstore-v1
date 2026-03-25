<?php

namespace Database\Seeders;

use App\Models\Buyer;
use App\Models\ShippingAddress;
use Illuminate\Database\Seeder;

class ShippingAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buyers = Buyer::all();
        ShippingAddress::factory()
            ->count($buyers->count())
            ->sequence(fn ($sequence) => ['buyer_id' => $buyers->get($sequence->index)])
            ->create();
    }
}
