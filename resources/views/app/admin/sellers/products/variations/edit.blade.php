<x-admin.root>
    <x-admin.page-header title="Edit {{ $variation->name ?: $variation->sku }}"
        description="Update this variation for the product {{ $product->name }}" />
    <x-seller.product-variations.form
        action="{{ route('admin.seller.product.variations.update', ['seller' => $seller, 'product' => $product, 'variation' => $variation]) }}"
        title="Update variation" :product="$product" :description="'Edit the variation for the product ' . $product->name" alert_title="Variation Update Failed"
        :variation="$variation" />
</x-admin.root>
