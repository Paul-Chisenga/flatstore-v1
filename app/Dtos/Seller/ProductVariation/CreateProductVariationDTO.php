<?php

namespace App\Dtos\Seller\ProductVariation;

use App\Contracts\Dto;

class CreateProductVariationDTO implements Dto
{
    public function __construct(
        public string $sku,
        public ?string $name,
        public float $price,
        public ?float $weight,
        public ?float $width,
        public ?float $height,
        public ?float $depth,
        public bool $is_default,
        public array $attribute_value_ids,
        public int $product_id,
    ) {}

    public static function fromArray(array $data): static
    {
        return new self(
            sku: $data['sku'],
            name: $data['name'] ?? null,
            price: (float) $data['price'],
            weight: isset($data['weight']) ? (float) $data['weight'] : null,
            width: isset($data['width']) ? (float) $data['width'] : null,
            height: isset($data['height']) ? (float) $data['height'] : null,
            depth: isset($data['depth']) ? (float) $data['depth'] : null,
            is_default: filter_var($data['is_default'] ?? false, FILTER_VALIDATE_BOOLEAN),
            attribute_value_ids: array_map('intval', $data['attribute_value_ids'] ?? []),
            product_id: (int) $data['product_id'],
        );
    }
}
