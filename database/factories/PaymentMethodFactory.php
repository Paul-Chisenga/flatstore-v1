<?php

namespace Database\Factories;

use App\Enums\PaymentMethodName;
use App\Enums\PaymentMethodProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentMethod>
 */
class PaymentMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(PaymentMethodName::values()),
            'provider' => $this->faker->randomElement(PaymentMethodProvider::values()),
            'is_active' => $this->faker->boolean(80), // 80% chance of being active
        ];
    }
}
