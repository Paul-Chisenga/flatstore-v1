<x-admin.root>
    <x-admin.page-header title="Product" description="Manage your store's products.">
        <x-ui.button class="ms-3" href="{{ route('admin.products.edit', $product) }}">
            Edit Product
        </x-ui.button>
    </x-admin.page-header>
</x-admin.root>
