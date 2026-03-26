<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\Auth\RegisterService;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function __construct(private RegisterService $registerService) {}

    public function index(): View
    {
        return view('app.auth.register');
    }

    public function registerWeb(RegisterRequest $request)
    {
        $validated = $request->validated();

        $this->registerService->registerWeb($validated);

        // redirect to intended page or the protected page
        return redirect()->intended(route('protected', absolute: false));
    }
}
