<?php

namespace App\Dtos\Admin\Seller;

class SellerItemDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $store_type,
        public string $created_at,
        public int $products_count,
        public array $stores,
    ) {
        //
    }
}
