<?php

namespace Database\Factories;

use App\Enums\ShipmentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipment>
 */
class ShipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "tracking_number" => $this->faker->uuid(),
            "carrier" => $this->faker->company(),
            "status" => $this->faker->randomElement(ShipmentStatus::values()),
            "shipped_at" => $this->faker->dateTimeBetween('-1 month', 'now'),
            "delivered_at" => $this->faker->dateTimeBetween('now', '+1 month'),
            "estimated_delivery" => $this->faker->dateTimeBetween('now', '+2 weeks'),
            "shipping_cost" => $this->faker->randomFloat(2, 5, 50), // Random cost between $5 and $50
        ];
    }
}
