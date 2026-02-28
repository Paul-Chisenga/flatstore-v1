<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SellerShippingMethod>
 */
class SellerShippingMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "shipping_cost" => $this->faker->randomFloat(2, 5, 50), // Random cost between $5 and $50
            "estimated_delivery_time" => $this->faker->numberBetween(1, 14) . ' days', // Random delivery time
            "is_enabled" => $this->faker->boolean(), // Randomly enable or disable
        ];
    }
}
