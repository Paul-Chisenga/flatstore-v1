<?php

namespace App\Services\Auth;

use App\Actions\Auth\ResetPasswordAction;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Event;

class PasswordResetService
{
    public const SEND_RESET_LINK_FEEDBACK_MESSAGE = 'If your email is in our system, you will receive a password reset link shortly.';

    public const RESET_PASSWORD_ERROR_MESSAGE = 'Failed to reset your password.';

    /**
     * Create a new class instance.
     */
    public function __construct(private ResetPasswordAction $resetPasswordAction)
    {
        //
    }

    public function isSocialAccount(string $email): ?bool
    {
        $user = User::query()->where('email', $email)->first();

        return $user?->isSocialAccount();
    }

    public function resetPasswordWeb(array $validated): mixed
    {
        return $this->resetPasswordAction->execute($validated, function (User $user) {
            Event::dispatch(new PasswordReset($user));
        });
    }
}
