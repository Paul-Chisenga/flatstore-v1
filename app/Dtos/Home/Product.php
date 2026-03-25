<?php

namespace App\Dtos\Home;

readonly class Product
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public int $id,
        public string $name,
        public string $price,
        public string $rating,
        public string $image,
    ) {}
}
