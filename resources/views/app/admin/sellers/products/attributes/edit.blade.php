<x-admin.root>
    <x-admin.page-header title="{{ $attribute->name }}"
        description="Edit [{{ $attribute->name }}] attribute for the product {{ $product->name }}" />
    <x-seller.product-attributes.form
        action="{{ route('admin.seller.product.attributes.update', ['seller' => $seller, 'product' => $product, 'attribute' => $attribute]) }}"
        title="Update attribute" :description="'Edit the attribute for the product ' . $product->name" alert_title="Attribute Update Failed" :attribute="$attribute" />
</x-admin.root>
