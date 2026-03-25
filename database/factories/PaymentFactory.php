<?php

namespace Database\Factories;

use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomFloat(2, 20, 500),
            'currency' => $this->faker->currencyCode(),
            'status' => $this->faker->randomElement(PaymentStatus::values()),
            'transaction_reference' => $this->faker->uuid(),
        ];
    }
}
