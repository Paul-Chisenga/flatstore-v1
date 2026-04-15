<?php

namespace App\Dtos\Seller\Store;

use App\Contracts\Dto;
use Illuminate\Http\UploadedFile;

class CreateStoreDTO implements Dto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        // store details
        public int $seller_id,
        public string $store_name,
        public ?string $store_email,
        public ?string $store_phone,
        public ?UploadedFile $logo,

        // address details
        public string $country,
        public string $state,
        public string $city,
        public string $street,
        public ?string $postal_code = null,
    ) {
        //
    }

    /**
     * {@inheritDoc}
     */
    public static function fromArray(array $data): static
    {
        return new static(
            seller_id: $data['seller_id'],
            store_name: $data['store_name'],
            store_email: $data['store_email'] ?? null,
            store_phone: $data['store_phone'] ?? null,
            logo: $data['logo'] ?? null,
            country: $data['country'],
            state: $data['state'],
            city: $data['city'],
            street: $data['street'],
            postal_code: $data['postal_code'] ?? null,
        );

    }
}
