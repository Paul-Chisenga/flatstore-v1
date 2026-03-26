<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\Auth\PasswordResetService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use SensitiveParameter;

class PasswordResetController extends Controller
{
    public function __construct(private PasswordResetService $passwordResetService)
    {
        //
    }

    // Web password forgot methods
    public function forgotPassword(): View
    {
        return view('app.auth.forgot-password');
    }

    public function sendResetLinkWeb(ForgotPasswordRequest $request)
    {
        $email = $request->validated('email');

        // Social account: silently succeed without sending — prevents enumeration
        // and avoids exposing account-state info to the user
        if ($this->passwordResetService->isSocialAccount($email) === true) {
            return back()->with('status', PasswordResetService::SEND_RESET_LINK_FEEDBACK_MESSAGE);
        }

        $status = Password::sendResetLink(['email' => $email]);

        return back()->with('status', PasswordResetService::SEND_RESET_LINK_FEEDBACK_MESSAGE);
    }

    public function resetPasswordForm(#[SensitiveParameter()] string $token, Request $request): View
    {
        return view(
            'app.auth.reset-password',
            ['token' => $token, 'email' => $request->string('email')]
        );
    }

    public function resetPasswordWeb(ResetPasswordRequest $request)
    {
        $validated = $request->validated();

        if ($this->passwordResetService->isSocialAccount($validated['email']) === true) {
            return back()->withErrors(['email' => [PasswordResetService::RESET_PASSWORD_ERROR_MESSAGE]]);
        }

        $status = $this->passwordResetService->resetPasswordWeb($validated);
        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        } else {
            return back()->onlyInput('email')->withErrors(['email' => [PasswordResetService::RESET_PASSWORD_ERROR_MESSAGE]]);
        }
    }
}
