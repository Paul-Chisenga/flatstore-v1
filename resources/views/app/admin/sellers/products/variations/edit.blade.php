<x-admin.root>
    <x-admin.page-header title="Edit {{ $variation->name ?: $variation->sku }}"
        description="Update this variation for the product {{ $product->name }}">
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
                        <x-ui.breadcrumb.link
                            href="{{ route('admin.seller.products.show', ['seller' => $seller, 'product' => $product]) }}">{{ $product->name }}</x-ui.breadcrumb.link>
                    </x-ui.breadcrumb.item>
                    <x-ui.breadcrumb.separator />
                    <x-ui.breadcrumb.item>
                        <x-ui.breadcrumb.page>Edit Variation</x-ui.breadcrumb.page>
                    </x-ui.breadcrumb.item>
                </x-ui.breadcrumb.list>
            </x-ui.breadcrumb>
        </x-slot:breadcrumb>
    </x-admin.page-header>
    <x-seller.product-variations.form
        action="{{ route('admin.seller.product.variations.update', ['seller' => $seller, 'product' => $product, 'variation' => $variation]) }}"
        title="Update variation" :product="$product" :description="'Edit the variation for the product ' . $product->name" alert_title="Variation Update Failed"
        :variation="$variation" />
</x-admin.root>
