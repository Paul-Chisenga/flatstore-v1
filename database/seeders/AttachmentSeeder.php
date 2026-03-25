<?php

namespace Database\Seeders;

use App\Models\Attachment;
use App\Models\ProductMedia;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Profiles
        $profiles = Profile::all();
        Attachment::factory()
            ->count(2)
            ->sequence(
                fn (Sequence $sequence) => [
                    'attachable_id' => $profiles[$sequence->index],
                    'attachable_type' => Profile::class,
                ]
            )->create();

        // Product media
        $productMedia = ProductMedia::all();
        Attachment::factory()
            ->count($productMedia->count())
            ->sequence(
                fn (Sequence $sequence) => [
                    'attachable_id' => $productMedia->get($sequence->index),
                    'attachable_type' => ProductMedia::class,
                ]
            )->create();
    }
}
