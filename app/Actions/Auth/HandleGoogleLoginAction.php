<?php

namespace App\Actions\Auth;

use App\Dtos\Auth\CreateUserDTO;
use App\Enums\SocialProvider;
use App\Models\User;
use Str;

class HandleGoogleLoginAction
{
    public function __construct(private CreateUserAction $createUserAction, private ResolveSocialiteTargetAction $resolveSocialiteTargetAction) {}

    public function execute($api = false): User
    {
        $socialite = $this->resolveSocialiteTargetAction->execute($api);

        // calling stateless on the web because the resolver already configures
        // the driver to be stateless for API and non-stateless for web, so we
        // can just call user() or stateless()->user() based on the $api flag
        $user = $api ? $socialite->user() : $socialite->stateless()->user();
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

        return $user;
    }
}
