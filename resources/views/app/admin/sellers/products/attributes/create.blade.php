<x-admin.root>
    <x-admin.page-header title="Add Attribute to {{ $product->name }}"
        description="Create a new attribute for the product {{ $product->name }}" />
    <x-seller.product-attributes.form
        action="{{ route('admin.seller.product.attributes.store', ['seller' => $seller, 'product' => $product]) }}"
        title="Create attribute" :description="'Create a new attribute for the product ' . $product->name" alert_title="Attribute Creation Failed" />
</x-admin.root>
