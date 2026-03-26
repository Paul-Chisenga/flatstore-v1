<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Auth\LoginService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laravel\Socialite\Socialite;

class LoginController extends Controller
{
    public function __construct(private LoginService $loginService)
    {
        //
    }

    // Web login methods
    public function index(Request $request): View
    {
        return view('app.auth.login');
    }

    public function loginWeb(LoginRequest $request)
    {

        if ($this->loginService->attemptLogin($request->all())) {
            return redirect()->intended(route('protected', absolute: false));
        }

        return back()->withErrors(['email' => 'Invalid Email or Password.'])->onlyInput('email');
    }

    // Google social login methods
    public function googleRedirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleLogin(): RedirectResponse
    {
        try {

            $this->loginService->googleLogin();

            return redirect(route('protected', absolute: false)); // Redirect to your desired location after successful authentication
        } catch (\Exception $e) {
            // log the error for debugging purposes
            \Log::error('Google authentication failed: '.$e->getMessage());

            return redirect(route('login'))->withErrors(['login_error' => ['Google authentication failed. Please try again.']]);
        }
    }
}
