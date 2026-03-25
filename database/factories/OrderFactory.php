<?php

namespace Database\Factories;

use App\Enums\OrderPaymentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payment_status' => $this->faker->randomElement(OrderPaymentStatus::values()),
        ];
    }
}
