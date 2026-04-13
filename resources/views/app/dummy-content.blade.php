<x-root>
    <x-headers.guest>
        <div class="space-y-4">
            {{-- Status message --}}
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif
            {{-- Categories --}}
            <form method="POST" action="{{ route('dummy.categories') }}">
                @csrf
                <x-ui.button type="submit" class="ms-3">
                    Fetch Categories
                </x-ui.button>
            </form>
            {{-- Products --}}
            <form method="POST" action="{{ route('dummy.products') }}">
                @csrf
                <x-ui.button type="submit" class="ms-3">
                    Fetch Products
                </x-ui.button>
            </form>
        </div>
    </x-headers.guest>
</x-root>
