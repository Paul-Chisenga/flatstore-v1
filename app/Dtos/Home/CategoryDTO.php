<?php

namespace App\Dtos\Home;

class CategoryDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public int $id,
        public string $name,
        public string $icon, // current assuming ionic icons
    ) {
        //
    }
}
