<header class="sticky top-0 z-50 mb-4 bg-gray-700 py-2">
    <div class="mx-auto flex max-w-screen-2xl items-center justify-between gap-6 px-4 md:px-6 lg:px-8">
        {{-- Logo --}}
        <a href="{{ route('seller.dashboard') }}">
            <x-common.logo />
        </a>
        {{-- Nav --}}
        <nav class="hidden md:flex gap-6">
            <x-headers.seller.nav-link href="{{ route('seller.dashboard') }}">
                dashboard
            </x-headers.seller.nav-link>
            <x-headers.seller.nav-link href="{{ route('seller.products') }}">
                products
            </x-headers.seller.nav-link>
        </nav>
        {{-- Account --}}
        <div class="flex gap-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-ui.button type="submit" :intent="App\Enums\Components\Button\Intent::Secondary" :variant="App\Enums\Components\Button\Variant::Ghost">
                    Logout
                </x-ui.button>
            </form>
        </div>
    </div>
</header>
