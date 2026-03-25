<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // rate limit login attempts to prevent brute-force attacks
        RateLimiter::for('login', function (Request $request) {
            $ipThrottleKey = 'login|'.$request->ip();
            $emailThrottleKey = 'login|'.strtolower($request->input('email'));

            $throttle = function () {

                // if json request, return JSON response
                if (request()->expectsJson()) {
                    return response()->json([
                        'message' => 'Too many login attempts. Please try again in later.',
                    ], 429);
                }

                return back()->withErrors([
                    'email' => 'Too many login attempts. Please try again in later.',
                ])->onlyInput('email');
            };

            return [
                Limit::perMinute(100)->by($ipThrottleKey)->response($throttle),
                Limit::perMinute(5)->by($emailThrottleKey)->response($throttle),
            ];
        });

        // rate limit email verification attempts to prevent abuse
        RateLimiter::for('forgot-password', function (Request $request) {
            $ipThrottleKey = 'forgot-password|'.$request->ip();
            $emailThrottleKey = 'forgot-password|'.strtolower($request->input('email'));

            return [
                Limit::perHour(10)->by($ipThrottleKey),
                Limit::perHour(3)->by($emailThrottleKey),
            ];
        });

        RateLimiter::for('reset-password', function (Request $request) {
            $ipThrottleKey = 'reset-password|'.$request->ip();
            $emailThrottleKey = 'reset-password|'.strtolower($request->input('email'));

            return [
                Limit::perHour(5)->by($ipThrottleKey),
                Limit::perHour(3)->by($emailThrottleKey),
            ];
        });

        // Password validation rules
        Password::defaults(function (): Password {
            // if in development environment, use simple password rules
            if (app()->environment('local')) {
                return Password::min(4);
            }

            return Password::min(8)->letters()->mixedCase()->numbers()->symbols();
        });
    }
}
