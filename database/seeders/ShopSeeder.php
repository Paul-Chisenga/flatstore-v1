<?php

namespace Database\Seeders;

use App\Models\Seller;
use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sellers = Seller::all();
        Shop::factory()
            ->count($sellers->count())
            ->sequence(
                fn(Sequence $sequence) => ["seller_id" => $sellers[$sequence->index]]
            )
            ->create();
    }
}
