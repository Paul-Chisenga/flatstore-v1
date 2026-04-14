<?php

namespace App\Dtos\Auth;

use App\Contracts\Dto;

class LoginDTO implements Dto
{
    /**
     * Create a new class instance.
     */
    public function __construct(public string $email, public string $password, public bool $remember = false)
    {
        //
    }

    public static function fromArray(array $data): static
    {
        return new self(
            email: $data['email'],
            password: $data['password'],
            remember: $data['remember'] ?? false,
        );
    }
}
