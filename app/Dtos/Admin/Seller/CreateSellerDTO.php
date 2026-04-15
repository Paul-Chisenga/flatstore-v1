<?php

namespace App\Dtos\Admin\Seller;

use App\Contracts\Dto;
use App\Enums\SellerRole;
use Illuminate\Http\UploadedFile;

class CreateSellerDTO implements Dto
{
    public function __construct(
        // Business entity fields
        public string $business_name,
        public string $business_email,
        public string $business_type,
        public ?string $business_phone,
        public ?UploadedFile $logo,
        public SellerRole $seller_role,
        // Credentials fields
        public string $email,
        public string $password,
        // contact person fields
        public ?string $first_name = null,
        public ?string $last_name = null,
        public ?string $contact_phone = null,
        public ?string $contact_email = null,
        public ?string $birth_date = null,
    ) {}

    public static function fromArray(array $data): static
    {
        return new self(
            business_name: $data['business_name'],
            business_email: $data['business_email'],
            business_type: $data['business_type'],
            business_phone: $data['business_phone'] ?? null,
            logo: $data['logo'] ?? null,
            seller_role: SellerRole::from($data['seller_role'] ?? SellerRole::Owner->value),
            email: $data['email'],
            password: $data['password'],
            first_name: $data['first_name'] ?? null,
            last_name: $data['last_name'] ?? null,
            contact_phone: $data['contact_phone'] ?? null,
            contact_email: $data['contact_email'] ?? null,
            birth_date: $data['birth_date'] ?? null,
        );
    }
}
