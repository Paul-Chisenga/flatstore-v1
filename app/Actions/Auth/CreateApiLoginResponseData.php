<?php

namespace App\Actions\Auth;

use App\Models\User;

use function boolval;

class CreateApiLoginResponseData
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function execute(User $user): array
    {
        $token = $user->createToken('api-token')->plainTextToken;
        $responseData = [
            'token' => $token,
            'user' => [
                'name' => "{$user->profile->first_name} {$user->profile->last_name}",
                'email' => $user->email,
                'avatar' => null, // Placeholder for avatar URL if you have one
                'email_verified' => boolval($user->email_verified_at),
            ],
        ];

        return $responseData;
    }
}
