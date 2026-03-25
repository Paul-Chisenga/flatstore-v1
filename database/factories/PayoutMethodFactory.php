<?php

namespace Database\Factories;

use App\Enums\PayoutMethodName;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PayoutMethod>
 */
class PayoutMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(PayoutMethodName::values()), // example methods
            'description' => $this->faker->sentence(), // random description
            'currency' => $this->faker->randomElement(['USD', 'EUR', 'GBP']), // example currencies
            'is_active' => $this->faker->boolean(80), // 80% chance of being active
        ];
    }
}
