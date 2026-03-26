<?php

namespace App\Dtos\Auth;

class CreateUserDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public ?string $provider_id = null,
        public ?string $provider = null,
        public ?\DateTime $email_verified_at = null,
    ) {
        //
    }

    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
            provider_id: $data['provider_id'] ?? null,
            provider: $data['provider'] ?? null,
            email_verified_at: $data['email_verified_at'] ?? null,
        );
    }
}
