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
        // primary store fields
        public string $store_name = '',
        public ?string $store_email = null,
        public ?string $store_phone = null,
        public ?UploadedFile $store_logo = null,
        public string $country = '',
        public string $state = '',
        public string $city = '',
        public string $street = '',
        public ?string $postal_code = null,
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
            store_name: $data['store_name'],
            store_email: $data['store_email'] ?? null,
            store_phone: $data['store_phone'] ?? null,
            store_logo: $data['store_logo'] ?? null,
            country: $data['country'],
            state: $data['state'],
            city: $data['city'],
            street: $data['street'],
            postal_code: $data['postal_code'] ?? null,
        );
    }
}
