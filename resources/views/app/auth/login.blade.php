<x-root>
    <x-headers.guest>
        <!-- Session Status -->
        <x-auth.session-status class="mb-4" :status="session('status')" />

        {{-- Display login error message --}}
        @error('login_error')
            <div class="mb-4 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ $message }}
            </div>
        @enderror

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <!-- Email Address -->
            <x-ui.field.field>
                <x-ui.field.field-label for="email">Email</x-ui.field.field-label>
                <x-ui.input-group.input-group>
                    <x-ui.input-group.addon>
                        <ion-icon name="mail"></ion-icon>
                    </x-ui.input-group.addon>
                    <x-ui.input-group.input id="email" name="email" :value="old('email')" autofocus
                        autocomplete="username" />
                </x-ui.input-group.input-group>
                <x-ui.field.field-error :messages="$errors->get('email')" />
            </x-ui.field.field>

            <!-- Password -->
            <x-ui.field.field class="mt-4">
                <x-ui.field.field-label for="password">Password</x-ui.field.field-label>
                <x-form-inputs.password id="password" name="password" autocomplete="current-password" />
                <x-ui.field.field-error :messages="$errors->get('password')" />
            </x-ui.field.field>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                @endif

                <x-ui.button type="submit" class="ms-3">
                    Log in
                </x-ui.button>
            </div>
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('register') }}">
                Don't have an account?
            </a>
            {{-- Social login using button --}}
            <div class="mt-4">
                <a href="{{ route('google.redirect') }}">
                    <x-ui.button :intent="App\Enums\Components\Button\Intent::Danger" class="w-full">
                        <ion-icon name="logo-google" class="me-2"></ion-icon>
                        Log in with Google
                    </x-ui.button>
                </a>
            </div>
        </form>
    </x-headers.guest>
</x-root>