<?php

namespace App\Dtos\Seller\ProductAttribute;

class UpdateProductAttributeDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $name,
        public array $values,
    ) {
        //
    }

    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            values: array_map('trim', explode(',', $data['values'])),
        );
    }
}
