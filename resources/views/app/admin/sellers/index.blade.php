<x-admin.root>
    <x-admin.page-header title="Sellers" description="Manage your store's sellers.">
        <x-ui.button class="ms-3" href="{{ route('admin.sellers.create') }}">
            Create Seller
        </x-ui.button>
    </x-admin.page-header>
    @if (count($sellers) === 0)
        <x-ui.empty.empty-state class="mt-8">
            <x-ui.empty.empty-header>
                No sellers found
            </x-ui.empty.empty-header>
            <p class="text-muted-foreground">
                Get started by creating a new seller.
            </p>
            <x-ui.button class="mt-4" href="{{ route('admin.sellers.create') }}">
                Create Seller
            </x-ui.button>
        </x-ui.empty.empty-state>
    @else
        <x-ui.item.item-group
            class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-6">
            @foreach ($sellers as $seller)
                <x-cards.admin.seller :seller="$seller" />
            @endforeach
        </x-ui.item.item-group>
    @endif
</x-admin.root>
