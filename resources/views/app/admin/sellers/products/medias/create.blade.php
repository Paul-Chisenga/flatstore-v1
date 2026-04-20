<x-admin.root>
    <x-admin.page-header title="Add Media" description="Upload a media file for this product.">
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
                        <x-ui.breadcrumb.page>Add Media</x-ui.breadcrumb.page>
                    </x-ui.breadcrumb.item>
                </x-ui.breadcrumb.list>
            </x-ui.breadcrumb>
        </x-slot:breadcrumb>
    </x-admin.page-header>

    <x-seller.product-medias.form :action="route('admin.seller.product.medias.store', ['seller' => $seller, 'product' => $product])" :product="$product" title="Create product media"
        description="Upload and organize product media from here." alert_title="Product Media Creation Failed" />
</x-admin.root>
