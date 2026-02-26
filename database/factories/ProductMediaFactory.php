<?php

namespace Database\Factories;

use App\Enums\ProductMediaType;
use App\Models\ProductMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductMedia>
 */
class ProductMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "type" => $this->faker->randomElement(ProductMediaType::values()),
            "is_primary" => false,
        ];
    }

    /**
     * Configure the factory to handle product_id from ProductVariation relationships.
     */
    public function configure(): static
    {
        return $this->afterMaking(function (ProductMedia $productMedia) {
            // If product_variation_id is set but product_id is not, get it from the variation
            if ($productMedia->product_variation_id && !$productMedia->product_id) {
                $productMedia->product_id = $productMedia->productVariation->product_id;
            }
        });
    }
}
