<?php

namespace App\Dtos\Admin\Brand;

use App\Contracts\Dto;

class CreateBrandDTO implements Dto
{
    /**
     * Create a new class instance.
     */
    public function __construct(public string $name, public ?string $description = null)
    {
        //
    }

    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            description: $data['description'] ?? null
        );
    }
}
