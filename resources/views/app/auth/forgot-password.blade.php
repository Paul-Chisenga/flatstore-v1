<x-root>
    <x-headers.guest>
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth.session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
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

            <div class="flex items-center justify-end mt-4">
                <x-ui.button type="submit">
                    {{ __('Email Password Reset Link') }}
                </x-ui.button>
            </div>
        </form>
    </x-headers.guest>
</x-root>
