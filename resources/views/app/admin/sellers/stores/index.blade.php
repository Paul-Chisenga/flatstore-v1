<x-admin.root>
    <x-admin.page-header title="Stores for {{ $seller->name }}" description="Manage stores for this seller.">
        <x-slot:breadcrumb>
            <x-ui.breadcrumb>
                <x-ui.breadcrumb.list>
                    <x-ui.breadcrumb.item>
                        <x-ui.breadcrumb.link href="{{ route('admin.dashboard') }}">Dashboard</x-ui.breadcrumb.link>
                    </x-ui.breadcrumb.item>
                    <x-ui.breadcrumb.separator />
                    <x-ui.breadcrumb.item>
                        <x-ui.breadcrumb.link href="{{ route('admin.sellers') }}">Sellers</x-ui.breadcrumb.link>
                    </x-ui.breadcrumb.item>
                    <x-ui.breadcrumb.separator />
                    <x-ui.breadcrumb.item>
                        <x-ui.breadcrumb.link
                            href="{{ route('admin.sellers.show', $seller) }}">{{ $seller->name }}</x-ui.breadcrumb.link>
                    </x-ui.breadcrumb.item>
                    <x-ui.breadcrumb.separator />
                    <x-ui.breadcrumb.item>
                        <x-ui.breadcrumb.page>Stores</x-ui.breadcrumb.page>
                    </x-ui.breadcrumb.item>
                </x-ui.breadcrumb.list>
            </x-ui.breadcrumb>
        </x-slot:breadcrumb>
        <x-ui.button class="ms-3" href="{{ route('admin.seller.stores.create', ['seller' => $seller]) }}">
            Create Store
        </x-ui.button>
    </x-admin.page-header>
    @if ($stores->isEmpty())
        <x-ui.empty.empty-state class="mt-8">
            <x-ui.empty.empty-header>
                No stores found
            </x-ui.empty.empty-header>
            <p class="text-muted-foreground">
                Get started by creating a new store.
            </p>
            <x-ui.button class="mt-4" href="{{ route('admin.seller.stores.create', ['seller' => $seller]) }}">
                Create Store
            </x-ui.button>
        </x-ui.empty.empty-state>
    @else
        <x-ui.item.item-group class="mt-8">
            @foreach ($stores as $store)
                <x-cards.seller.store :store="$store" />
            @endforeach
        </x-ui.item.item-group>
    @endif
</x-admin.root>
