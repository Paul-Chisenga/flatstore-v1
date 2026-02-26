<?php

namespace Database\Seeders;

use App\Enums\RoleName;
use App\Models\Attachment;
use App\Models\Buyer;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Buyer::factory()
            ->for(
                User::factory()
                    ->has(Profile::factory()
                        ->has(Attachment::factory(), 'profilePhoto'), 'profile')
                    ->has(Role::factory()->state(["name" => RoleName::Buyer->value]), 'role'),
                'user'
            )
            ->create();
    }
}
