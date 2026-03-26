<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Contracts\Auth\PasswordBroker;
use SensitiveParameter;
use Str;

class ResetPasswordAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(private PasswordBroker $passwordBroker)
    {
        //
    }

    public function execute(array $validated, callable $callback): mixed
    {
        $status = $this->passwordBroker->reset(
            $validated,
            function (User $user, #[SensitiveParameter] string $password) use ($callback) {
                $user->password = $password;
                $user->setRememberToken(Str::random(60));
                $user->save();

                // call the callback to perform any additional actions (e.g., dispatching events)
                $callback($user);
            }
        );

        return $status;
    }
}
