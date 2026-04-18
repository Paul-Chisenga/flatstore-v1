<?php

namespace App\Dtos\Seller\ProductVariation;

use App\Contracts\Dto;

class CreateVariationStockDTO implements Dto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public int $store_id,
        public int $stock
    ) {
        //
    }

    /**
     * {@inheritDoc}
     */
    public static function fromArray(array $data): static
    {
        return new static(
            store_id: $data['store_id'],
            stock: $data['stock']
        );
    }
}
