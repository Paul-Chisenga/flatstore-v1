<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function __construct(private Dispatcher $events) {}

    public function index(): View
    {
        return view('app.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => UserRole::Buyer,
        ]);

        // dispatch registered event for any listeners (e.g. send welcome email)
        $this->events->dispatch(new Registered($user));

        // log the user in after registration
        Auth::login($user);

        // redirect to intended page or the protected page
        return redirect()->intended(route('protected', absolute: false));
    }
}
