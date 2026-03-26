<?php

namespace App\Services\Auth;

use App\Actions\Auth\CreateUserAction;
use App\Dtos\Auth\CreateUserDTO;
use App\Dtos\Auth\LoginDTO;
use App\Enums\SocialProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Socialite;
use Str;

class LoginService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private CreateUserAction $createUserAction)
    {
        //
    }

    public function attemptLogin(array $data): bool
    {
        $loginDTO = LoginDTO::fromArray($data);

        return Auth::attempt(
            ['email' => $loginDTO->email, 'password' => $loginDTO->password],
            $loginDTO->remember
        );
    }

    public function googleLogin()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $createUserDTO = new CreateUserDTO(
            name: $user->name,
            email: $user->email,
            provider_id: $user->id,
            provider: SocialProvider::GOOGLE->value,
            password: Str::random(16), // Generate a random password since it's required, but won't be used for social login
            email_verified_at: now(), // Mark email as verified since it's coming from a trusted provider
        );

        // Check if the user already exists based on provider_id, otherwise create a new user
        $user = User::where('provider_id', $createUserDTO->provider_id)
            ->first() ?? $this->createUserAction->execute($createUserDTO);

        Auth::login($user);
    }
}
