<x-admin.root>
    <x-admin.page-header title="Add Variation to {{ $product->name }}"
        description="Create a new product variation for {{ $product->name }}" />
    <x-seller.product-variations.form
        action="{{ route('admin.seller.product.variations.store', ['seller' => $seller, 'product' => $product]) }}"
        title="Create variation" :product="$product" :description="'Create a new variation for the product ' . $product->name" alert_title="Variation Creation Failed" />
</x-admin.root>
