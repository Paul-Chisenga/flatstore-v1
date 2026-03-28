<?php

namespace App\Utils;

use Illuminate\Http\RedirectResponse;

class CustomerApp
{
    public static function getAppScheme(): string
    {
        return config('app.app_scheme', 'flatstore://');
    }

    public static function redirectToApp(string $path = '', mixed $data = null): RedirectResponse
    {
        $appScheme = self::getAppScheme();

        // Ensure the path does not start with a slash
        $path = ltrim($path, '/');

        // Construct the full URL to redirect to
        $redirectUrl = "$appScheme$path";

        // Json encode the data if it's provided
        if ($data !== null) {
            $encodedData = urlencode(json_encode($data));
            $redirectUrl .= "?data=$encodedData";
        }

        // assuming user is on the web and we want to redirect them to the app with a specific path
        return redirect($redirectUrl);
    }
}
