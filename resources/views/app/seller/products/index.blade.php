<x-seller.root>
    <x-seller.page-header title="Products" description="Manage your store's products.">
        <x-ui.button class="ms-3" href="{{ route('seller.products.create') }}">
            Create Product
        </x-ui.button>
    </x-seller.page-header>
    @if (count($products) === 0)
        <x-ui.empty.empty-state class="mt-8">
            <x-ui.empty.empty-header>
                No products found
            </x-ui.empty.empty-header>
            <p class="text-muted-foreground">
                Get started by creating a new product.
            </p>
            <x-ui.button class="mt-4" href="{{ route('seller.products.create') }}">
                Create Product
            </x-ui.button>
        </x-ui.empty.empty-state>
    @else
        <x-ui.item.item-group class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <x-cards.seller.product :product="$product" />
            @endforeach
        </x-ui.item.item-group>
    @endif
</x-seller.root>
