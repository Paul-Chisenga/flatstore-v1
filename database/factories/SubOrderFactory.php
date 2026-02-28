<?php

namespace Database\Factories;

use App\Enums\OrderFufillmentType;
use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubOrder>
 */
class SubOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "status" => $this->faker->randomElement(OrderStatus::values()),
            "fulfillment_type" => $this->faker->randomElement(OrderFufillmentType::values()),
            "seller_shipping_method_id" => $this->faker->numberBetween(1, 10), // Assuming you have 10 shipping methods seeded
        ];
    }
}
