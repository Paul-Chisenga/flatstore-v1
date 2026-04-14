<?php

namespace App\Dtos\Admin\Brand;

use App\Contracts\Dto;
use Illuminate\Http\UploadedFile;

class CreateBrandDTO implements Dto
{
    public function __construct(
        public string $name,
        public ?string $description = null,
        public ?UploadedFile $logo = null,
    ) {}

    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            description: $data['description'] ?? null,
            logo: $data['logo'] ?? null,
        );
    }
}
