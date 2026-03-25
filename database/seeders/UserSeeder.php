<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(2)->sequence(
            ['role' => UserRole::Buyer->value],
            ['role' => UserRole::Seller->value]
        )->create();
    }
}
