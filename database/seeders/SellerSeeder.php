<?php

namespace Database\Seeders;

use App\Enums\RoleName;
use App\Models\Attachment;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Seller;
use App\Models\Shop;
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
            ->for(
                User::factory()
                    ->has(Profile::factory()
                        ->has(Attachment::factory(), 'profilePhoto'), 'profile')
                    ->has(Role::factory()->state(["name" => RoleName::Seller->value]), 'role'),
                'user'
            )
            ->has(Shop::factory(), 'shops')
            ->create();
    }
}
