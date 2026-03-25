<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SellerPayoutMethod>
 */
class SellerPayoutMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'account_details' => $this->faker->bankAccountNumber(), // Example account details
            'is_enabled' => $this->faker->boolean(), // Randomly enable or disable
        ];
    }
}
