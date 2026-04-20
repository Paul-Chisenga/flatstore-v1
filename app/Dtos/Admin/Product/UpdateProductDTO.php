<?php

namespace App\Dtos\Admin\Product;

use App\Contracts\Dto;
use Illuminate\Http\UploadedFile;

class UpdateProductDTO implements Dto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $name,
        public string $seller_id,
        public ?string $brand_id,
        public ?string $description,
        public array $category_ids,
        public ?UploadedFile $thumbnail,
    ) {
        //
    }

    /**
     * {@inheritDoc}
     */
    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            seller_id: $data['seller_id'],
            brand_id: $data['brand_id'] ?? null,
            description: $data['description'] ?? null,
            category_ids: $data['category_ids'] ?? [],
            thumbnail: $data['thumbnail'] ?? null,
        );
    }
}
