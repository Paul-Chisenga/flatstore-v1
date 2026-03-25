<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Seeder;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Seller::factory()
            ->for(User::where('role', UserRole::Seller->value)->first())
            ->create();
    }
}
