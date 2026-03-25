<x-root>
    <x-headers.guest>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email Address -->
            <x-ui.field.field>
                <x-ui.field.field-label for="email">Email</x-ui.field.field-label>
                <x-ui.input-group.input-group>
                    <x-ui.input-group.addon>
                        <ion-icon name="mail"></ion-icon>
                    </x-ui.input-group.addon>
                    <x-ui.input-group.input id="email" name="email" :value="old('email', $email)" autofocus
                        autocomplete="username" />
                </x-ui.input-group.input-group>
                <x-ui.field.field-error :messages="$errors->get('email')" />
            </x-ui.field.field>

            <!-- Password -->
            <x-ui.field.field class="mt-4">
                <x-ui.field.field-label for="password">Password</x-ui.field.field-label>
                <x-form-inputs.password id="password" name="password" autocomplete="new-password" />
                <x-ui.field.field-error :messages="$errors->get('password')" />
            </x-ui.field.field>

            <!-- Confirm Password -->
            <x-ui.field.field class="mt-4">
                <x-ui.field.field-label for="password_confirmation">Confirm Password</x-ui.field.field-label>
                <x-form-inputs.password id="password_confirmation" name="password_confirmation"
                    autocomplete="new-password" />
                <x-ui.field.field-error :messages="$errors->get('password_confirmation')" />
            </x-ui.field.field>

            <div class="flex items-center justify-end mt-4">
                <x-ui.button type="submit">
                    {{ __('Reset Password') }}
                </x-ui.button>
            </div>
        </form>
    </x-headers.guest>
</x-root>
