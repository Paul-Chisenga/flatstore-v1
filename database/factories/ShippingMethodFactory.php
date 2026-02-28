<?php

namespace Database\Factories;

use App\Enums\ShippingMethodName;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShippingMethod>
 */
class ShippingMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->randomElement(ShippingMethodName::values()),
            "description" => $this->faker->sentence(),
            "estimated_days" => $this->faker->numberBetween(1, 7),
            "is_active" => $this->faker->boolean(90), // 90% chance to be active
        ];
    }
}
