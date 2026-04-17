<x-admin.root>
    <x-admin.page-header title="Products" description="Manage your store's products.">
        <x-ui.button class="ms-3" href="{{ route('admin.products.create') }}">
            Create Product
        </x-ui.button>
    </x-admin.page-header>

    @if ($products->count() === 0)
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
        <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($products as $product)
                <x-cards.admin.product :product="$product" />
            @endforeach
        </div>

        <div class="mt-6">
            {{ $products->links() }}
        </div>
    @endif
</x-admin.root>
