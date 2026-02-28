<?php

namespace Database\Factories;

use App\Enums\PayoutStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payout>
 */
class PayoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "amount" => $this->faker->randomFloat(2, 10, 1000), // random amount between 10 and 1000
            "currency" => $this->faker->currencyCode(), // random 3-letter currency
            "status" => $this->faker->randomElement(PayoutStatus::values()), // random status
            "transaction_reference" => $this->faker->uuid(), // random UUID as transaction reference
        ];
    }
}
