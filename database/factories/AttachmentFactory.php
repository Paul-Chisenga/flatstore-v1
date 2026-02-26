<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attachment>
 */
class AttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "file_name" => $this->faker->word() . "." . "png",
            "file_type" => $this->faker->mimeType(),
            "file_size" => $this->faker->numberBetween(1000, 1000000),
            "file_url" => $this->faker->imageUrl(),
        ];
    }
}
