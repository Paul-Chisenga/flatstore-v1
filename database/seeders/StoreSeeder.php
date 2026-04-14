<?php

namespace Database\Seeders;

use App\Models\Seller;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sellers = Seller::all();
        Store::factory()
            ->count($sellers->count())
            ->sequence(
                fn (Sequence $sequence) => ['seller_id' => $sellers[$sequence->index]]
            )
            ->create();
    }
}
