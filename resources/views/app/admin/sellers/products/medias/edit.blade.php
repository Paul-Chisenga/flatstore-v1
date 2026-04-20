<x-admin.root>
    <x-admin.page-header title="Edit Media" description="Update this media item for the product.">
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
                        <x-ui.breadcrumb.page>Edit Media</x-ui.breadcrumb.page>
                    </x-ui.breadcrumb.item>
                </x-ui.breadcrumb.list>
            </x-ui.breadcrumb>
        </x-slot:breadcrumb>
    </x-admin.page-header>

    <x-seller.product-medias.form :action="route('admin.seller.product.medias.update', [
        'seller' => $seller,
        'product' => $product,
        'media' => $media,
    ])" :product="$product" :media="$media" title="Update product media"
        description="Update the selected media item for this product." alert_title="Product Media Update Failed" />
</x-admin.root>
