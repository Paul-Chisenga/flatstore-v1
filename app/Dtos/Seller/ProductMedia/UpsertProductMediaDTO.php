<?php

namespace App\Dtos\Seller\ProductMedia;

use App\Contracts\Dto;
use Illuminate\Http\UploadedFile;

class UpsertProductMediaDTO implements Dto
{
    public function __construct(
        public ?UploadedFile $file,
        public string $type,
        public ?int $product_variation_id,
        public bool $is_primary,
    ) {}

    public static function fromArray(array $data): static
    {
        return new static(
            file: $data['file'] ?? null,
            type: $data['type'],
            product_variation_id: isset($data['product_variation_id']) ? (int) $data['product_variation_id'] : null,
            is_primary: filter_var($data['is_primary'] ?? false, FILTER_VALIDATE_BOOLEAN),
        );
    }
}
