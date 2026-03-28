<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Utils\CustomerApp;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificatonController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('protected', absolute: false));
        }

        return view('app.auth.verify-email');
    }

    public function verifyWeb(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();

        return redirect()->intended(route('protected', absolute: false));
    }

    public function verifyApiRedirect(Request $request): RedirectResponse
    {
        // get query params from the request and redirect to the app with those params
        $queryParams = $request->query();

        return CustomerApp::redirectToApp('/auth/verify-email', [
            'id' => $request->route('id'),
            'hash' => $request->route('hash'),
            'query' => $queryParams,
        ]);
    }

    public function verifyApi(EmailVerificationRequest $request): JsonResponse
    {
        $request->fulfill();

        return response()
            ->json(['message' => 'Email verified successfully.'], 200);
    }

    public function resendWeb(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('protected', absolute: false));
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }

    public function resendApi(Request $request): JsonResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()
                ->json([
                    'message' => 'Email already verified.',
                    'status' => 'email-already-verified',
                ],
                    400);
        }

        $request->user()->sendEmailVerificationNotification(true); // pass true to indicate it's for API

        return response()
            ->json([
                'message' => 'Verification link sent.',
                'status' => 'verification-link-sent',
            ], 200);
    }
}
