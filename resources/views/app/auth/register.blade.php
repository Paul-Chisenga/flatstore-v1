<x-root>
    <x-headers.guest>
        <form method="POST" action="{{ route('register.post') }}">
            @csrf

            <!-- Name -->
            <x-ui.field.field>
                <x-ui.field.field-label for="name">Name</x-ui.field.field-label>
                <x-ui.input-group.input-group>
                    <x-ui.input-group.addon>
                        <ion-icon name="person"></ion-icon>
                    </x-ui.input-group.addon>
                    <x-ui.input-group.input id="name" name="name" :value="old('name')" autofocus
                        autocomplete="name" />
                </x-ui.input-group.input-group>
                <x-ui.field.field-error :messages="$errors->get('name')" />
            </x-ui.field.field>

            <!-- Email Address -->
            <x-ui.field.field class="mt-4">
                <x-ui.field.field-label for="email">Email</x-ui.field.field-label>
                <x-ui.input-group.input-group>
                    <x-ui.input-group.addon>
                        <ion-icon name="mail"></ion-icon>
                    </x-ui.input-group.addon>
                    <x-ui.input-group.input id="email" name="email" :value="old('email')" autocomplete="username" />
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
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}">
                    Already registered?
                </a>

                <x-ui.button type="submit" class="ms-3">
                    Register
                </x-ui.button>
            </div>
        </form>
    </x-headers.guest>
</x-root>
