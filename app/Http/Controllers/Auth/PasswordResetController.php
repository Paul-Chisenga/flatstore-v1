<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use SensitiveParameter;
use Str;

class PasswordResetController extends Controller
{
    public function forgotPassword(): View
    {
        return view('app.auth.forgot-password');
    }

    public function sendResetLinkEmail(ForgotPasswordRequest $request)
    {
        $email = $request->validated('email');

        $status = Password::sendResetLink(['email' => $email]);

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }

    public function resetPasswordForm(#[SensitiveParameter()] string $token, Request $request): View
    {
        return view('app.auth.reset-password',
            ['token' => $token, 'email' => $request->string('email')]
        );
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $validated = $request->validated();
        $status = Password::reset(
            $validated,
            function (User $user, #[SensitiveParameter] string $password) {
                $user->password = $password;
                $user->setRememberToken(Str::random(60));
                $user->save();

                Event::dispatch(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        } else {
            return back()->withErrors(['email' => [__($status)]]);
        }
    }
}
