<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Attachment;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::all();
        Profile::factory()->count(2)
        ->sequence(
            fn(Sequence $sequence) => ['user_id' => $user[$sequence->index]]
        )
        ->create();
    }
}
