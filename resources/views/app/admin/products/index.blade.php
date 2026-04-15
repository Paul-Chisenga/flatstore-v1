<x-admin.root>
    <x-admin.page-header title="Products" description="Manage your store's products.">
        <x-ui.button class="ms-3" href="{{ route('admin.products.create') }}">
            Create Product
        </x-ui.button>
    </x-admin.page-header>
    @if (count($products) === 0)
        <x-ui.empty.empty-state class="mt-8">
            <x-ui.empty.empty-header>
                No products found
            </x-ui.empty.empty-header>
            <p class="text-muted-foreground">
                Get started by creating a new product.
            </p>
            <x-ui.button class="mt-4" href="{{ route('admin.products.create') }}">
                Create Product
            </x-ui.button>
        </x-ui.empty.empty-state>
    @else
        <x-ui.item.item-group class="mt-8">
            @foreach ($products as $product)
                <x-cards.seller.product :product="$product" />
            @endforeach
        </x-ui.item.item-group>
    @endif
</x-admin.root>
