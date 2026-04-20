<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\ResolveSocialiteTargetAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Auth\LoginService;
use App\Utils\CustomerApp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(
        private LoginService $loginService,
        private ResolveSocialiteTargetAction $resolveSocialiteTargetAction
    ) {
        //
    }

    // Login methods
    public function index(Request $request): View
    {
        return view('app.auth.login');
    }

    public function loginWeb(LoginRequest $request)
    {

        if ($this->loginService->attemptLogin($request->all())) {
            $this->loginService->regenerateSessionWeb($request);

            return redirect()->intended(route('protected', absolute: false));
        }

        return back()->withErrors(['email' => 'Invalid Email or Password.'])->onlyInput('email');
    }

    public function loginApi(LoginRequest $request)
    {

        if ($this->loginService->attemptLogin($request->all())) {
            $loginResponse = $this->loginService->regenerateSessionApi($request);

            return response($loginResponse, status: 200);
        }

        return response()
            ->json([
                'message' => 'Invalid Email or Password.',
            ],
                status: 401);
    }

    // Google social login methods
    public function googleRedirectWeb(): RedirectResponse
    {
        return $this->resolveSocialiteTargetAction
            ->execute()
            ->redirect();
    }

    public function googleRedirectApi(): RedirectResponse
    {
        return $this->resolveSocialiteTargetAction
            ->execute(api: true)
            ->redirect();
    }

    public function googleLoginWeb(): RedirectResponse
    {
        try {

            $this->loginService->googleLoginWeb();

            return redirect(route('protected', absolute: false)); // Redirect to your desired location after successful authentication
        } catch (\Exception $e) {
            // log the error for debugging purposes
            \Log::error('Google authentication failed: '.$e->getMessage());

            return redirect(route('login'))->withErrors(['login_error' => ['Google authentication failed. Please try again.']]);
        }
    }

    public function googleLoginApi(): RedirectResponse
    {
        try {

            $loginResponseData = $this->loginService->googleLoginApi();

            return CustomerApp::redirectToApp('/auth/sign-in/social', $loginResponseData);
        } catch (\Exception $e) {
            // log the error for debugging purposes
            \Log::error('Google authentication failed on API: '.$e->getMessage());

            return CustomerApp::redirectToApp('/auth/sign-in/email',
                [
                    'message' => 'Google authentication failed. Please try again.',
                    'error' => true,
                ]
            );
        }
    }

    public function logoutWeb(Request $request): RedirectResponse
    {

        $this->loginService->logoutWeb();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function logoutApi(): JsonResponse
    {
        $this->loginService->logoutApi();

        return response()
            ->json(['message' => 'Logged out successfully.'],
                status: 200);
    }
}
