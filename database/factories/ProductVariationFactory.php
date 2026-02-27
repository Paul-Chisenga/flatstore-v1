<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariation>
 */
class ProductVariationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "sku" => $this->faker->unique()->bothify('SKU-####'),
            "name" => $this->faker->word(),
            "price" => $this->faker->randomFloat(2, 1, 100),
            "stock" => $this->faker->numberBetween(0, 100),
            "weight" => $this->faker->randomFloat(2, 0.1, 100),
            "width" => $this->faker->randomFloat(2, 0.1, 100),
            "height" => $this->faker->randomFloat(2, 0.1, 100),
            "depth" => $this->faker->randomFloat(2, 0.1, 100),
            "is_default" => false,
        ];
    }
}
