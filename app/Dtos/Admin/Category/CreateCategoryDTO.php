<?php

namespace App\Dtos\Admin\Category;

use App\Contracts\Dto;

class CreateCategoryDTO implements Dto
{
    public function __construct(
        public string $name,
        public ?string $description = null,
        public ?string $ionicon_name = null,
    ) {}

    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            description: $data['description'] ?? null,
            ionicon_name: $data['ionicon_name'] ?? null,
        );
    }
}
