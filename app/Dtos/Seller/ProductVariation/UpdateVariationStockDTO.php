<?php

namespace App\Dtos\Seller\ProductVariation;

use App\Contracts\Dto;

class UpdateVariationStockDTO implements Dto
{
    public function __construct(
        public int $stock,
        public bool $is_active,
    ) {}

    public static function fromArray(array $data): static
    {
        return new static(
            stock: (int) $data['stock'],
            is_active: filter_var($data['is_active'] ?? false, FILTER_VALIDATE_BOOLEAN),
        );
    }
}
