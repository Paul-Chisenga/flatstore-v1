<?php

namespace App\Services\Auth;

use App\Actions\Auth\CreateUserAction;
use App\Dtos\Auth\CreateUserDTO;
use Illuminate\Auth\Events\Registered;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;

class RegisterService
{
    public function __construct(private Dispatcher $events, private CreateUserAction $createUserAction)
    {
        //
    }

    public function registerWeb(array $data)
    {
        $user = $this->createUserAction->execute(CreateUserDTO::fromArray($data));

        // dispatch registered event for any listeners (e.g. send welcome email)
        $this->events->dispatch(new Registered($user));

        // log the user in after registration
        Auth::login($user);
    }
}
