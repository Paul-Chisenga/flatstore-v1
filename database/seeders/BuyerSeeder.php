<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Buyer;
use App\Models\User;
use Illuminate\Database\Seeder;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Buyer::factory()
            ->for(User::where('role', UserRole::Buyer->value)->first())
            ->create();
    }
}
