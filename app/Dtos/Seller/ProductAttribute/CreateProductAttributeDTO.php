<?php

namespace App\Dtos\Seller\ProductAttribute;

use App\Contracts\Dto;

class CreateProductAttributeDTO implements Dto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $name,
        public array $values,
        public int $product_id,
    ) {
        //
    }

    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            values: array_map('trim', explode(',', $data['values'])),
            product_id: $data['product_id'],
        );
    }
}
