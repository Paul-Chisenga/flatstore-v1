<?php

namespace App\Actions\Auth;

use App\Dtos\Auth\CreateUserDTO;
use App\Enums\UserRole;
use App\Models\User;

class CreateUserAction
{
    public function execute(CreateUserDTO $data)
    {
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => $data->password,
            'role' => UserRole::Buyer,
            'provider_id' => $data->provider_id,
            'provider' => $data->provider,
            'email_verified_at' => $data->email_verified_at,
        ]);

        return $user;
    }
}
