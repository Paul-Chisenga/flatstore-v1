<?php

namespace App\Dtos\Home;

class ProductDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public int $id,
        public string $name,
        public float $price,
        public float $rating,
        public string $image,
    ) {
        //
    }
}
