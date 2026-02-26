<?php

namespace Database\Seeders;

use App\Enums\RoleName;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory()->name(RoleName::SuperAdmin)->count(1)->create();
        Role::factory()->name(RoleName::Admin)->count(3)->create();
        Role::factory()->name(RoleName::Seller)->count(10)->create();
        Role::factory()->name(RoleName::Buyer)->count(60)->create();
    }
}
