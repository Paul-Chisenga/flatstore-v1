<x-root>
    <x-headers.guest>
        <form method="POST" action="{{ route('login.post') }}">
            <x-ui.button type="submit" class="ms-3">
                Log in
            </x-ui.button>
        </form>
    </x-headers.guest>
</x-root>
