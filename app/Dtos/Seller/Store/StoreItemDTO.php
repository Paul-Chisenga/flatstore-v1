<?php

namespace App\Dtos\Seller\Store;

class StoreItemDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $description,
        public ?string $logo_path,
        public string $created_at,
    ) {}
}
