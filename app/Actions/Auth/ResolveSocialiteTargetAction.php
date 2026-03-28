<?php

namespace App\Actions\Auth;

use Laravel\Socialite\Contracts\Provider;
use Laravel\Socialite\Socialite;

class ResolveSocialiteTargetAction
{
    public function execute($api = false): Provider
    {
        if ($api) {
            return Socialite::driver('google')
                ->redirectUrl(config('auth.api.google_redirect_uri'))
                ->stateless();

        }

        return Socialite::driver('google');
    }
}
