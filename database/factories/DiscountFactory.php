<?php

namespace Database\Factories;

use App\Enums\DiscountType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discount>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(DiscountType::values()),
            'value' => $this->faker->randomFloat(2, 5, 50),
            'valid_from' => $this->faker->dateTimeBetween('-1 month', 'now'), // Start date between 1 month ago and now
            'valid_to' => $this->faker->dateTimeBetween('now', '+1 month'), // End date between now and 1 month in the future
        ];
    }
}
