<?php

namespace App\Dtos\Admin\Seller;

use App\Contracts\Dto;
use App\Enums\RoleName;

class CreateSellerDTO implements Dto
{
    public function __construct(
        public string $store_type,
        public string $email,
        public string $password,
        public string $first_name,
        public string $last_name,
        public ?string $phone = null,
        public ?string $birth_date = null,
        public ?RoleName $role = null,
    ) {}

    public static function fromArray(array $data): static
    {
        return new self(
            store_type: $data['store_type'],
            email: $data['email'],
            password: $data['password'],
            first_name: $data['first_name'],
            last_name: $data['last_name'],
            phone: $data['phone'] ?? null,
            birth_date: $data['birth_date'] ?? null,
            role: isset($data['role']) ? RoleName::from($data['role']) : null,
        );
    }
}
