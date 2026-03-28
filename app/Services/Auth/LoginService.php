<?php

namespace App\Services\Auth;

use App\Actions\Auth\CreateApiLoginResponseData;
use App\Actions\Auth\CreateUserAction;
use App\Actions\Auth\HandleGoogleLoginAction;
use App\Dtos\Auth\LoginDTO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private CreateUserAction $createUserAction,
        private CreateApiLoginResponseData $createApiLoginResponseData,
        private HandleGoogleLoginAction $handleGoogleLoginAction
    ) {
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

    public function regenerateSessionWeb(Request $request): void
    {
        $request->session()->regenerate();
    }

    public function regenerateSessionApi(Request $request): array
    {
        return $this->createApiLoginResponseData
            ->execute($request->user());
    }

    public function googleLoginWeb(): void
    {
        $user = $this->handleGoogleLoginAction->execute();
        Auth::login($user);
    }

    public function googleLoginApi(): array
    {
        return $this->createApiLoginResponseData
            ->execute($this->handleGoogleLoginAction->execute(api: true));
    }

    public function logoutWeb(): void
    {
        Auth::logout();
    }

    public function logoutApi(): void
    {
        // Revoke all tokens...
        Auth::user()->tokens()->delete();
    }
}
