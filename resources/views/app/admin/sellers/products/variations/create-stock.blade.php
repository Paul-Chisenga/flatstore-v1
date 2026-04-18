@php
    /** @var \App\Models\Seller $seller */
    /** @var \App\Models\Product $product */
    /** @var \App\Models\ProductVariation $variation */

    $displayName = $variation->name ?: ($variation->attributeValues->pluck('value')->implode(' / ') ?: $variation->sku);
@endphp

<x-admin.root>
    <x-admin.page-header title="Add Stock" description="Assign new stock to the selected product variation.">
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
                        <x-ui.breadcrumb.link
                            href="{{ route('admin.seller.product.variations.show', ['seller' => $seller, 'product' => $product, 'variation' => $variation]) }}">{{ $displayName }}</x-ui.breadcrumb.link>
                    </x-ui.breadcrumb.item>
                    <x-ui.breadcrumb.separator />
                    <x-ui.breadcrumb.item>
                        <x-ui.breadcrumb.page>Add Stock</x-ui.breadcrumb.page>
                    </x-ui.breadcrumb.item>
                </x-ui.breadcrumb.list>
            </x-ui.breadcrumb>
        </x-slot:breadcrumb>
    </x-admin.page-header>
    <x-seller.stock.form
        action="{{ route('admin.seller.product.variations.stocks.store', ['seller' => $seller, 'product' => $product, 'variation' => $variation]) }}"
        title="Create Stock" description="Create a new stock for the product variation '{{ $displayName }}'"
        alert_title="Stock Creation Failed" :available_stores="$seller->stores" />
</x-admin.root>
