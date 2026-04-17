@php
    /** @var \App\Models\Product $product */
@endphp

<x-admin.root>
    <x-admin.page-header title="{{ $product->name }}" description="View and manage this product.">
        <x-ui.button class="ms-3" href="{{ route('admin.products.edit', $product) }}">
            Edit Product
        </x-ui.button>
    </x-admin.page-header>

    <div class="mt-8 grid gap-6 lg:grid-cols-3">
        <x-ui.card>
            <x-ui.card.card-header>
                <x-ui.card.card-title>Product Details</x-ui.card.card-title>
                <x-ui.card.card-description>Catalogue information and publishing state.</x-ui.card.card-description>
            </x-ui.card.card-header>
            <x-ui.card.card-content class="space-y-4 text-sm">
                <div>
                    <p class="text-muted-foreground">Seller</p>
                    <p class="font-medium">{{ $product->seller->name }}</p>
                </div>
                <div>
                    <p class="text-muted-foreground">Brand</p>
                    <p class="font-medium">{{ $product->brand?->name ?? 'Unbranded' }}</p>
                </div>
                <div>
                    <p class="text-muted-foreground">Status</p>
                    <x-ui.badge :intent="$product->status?->value === App\Enums\ProductStatus::Published->value
                        ? App\Enums\Components\Button\Intent::Success
                        : App\Enums\Components\Button\Intent::Muted">
                        {{ $product->status?->label() ?? ucfirst((string) $product->status) }}
                    </x-ui.badge>
                </div>
                <div>
                    <p class="text-muted-foreground">Categories</p>
                    <div class="mt-2 flex flex-wrap gap-2">
                        @foreach ($product->categories as $category)
                            <x-ui.badge :intent="App\Enums\Components\Button\Intent::Info">
                                {{ $category->name }}
                            </x-ui.badge>
                        @endforeach
                    </div>
                </div>
                <div>
                    <p class="text-muted-foreground">Created</p>
                    <p class="font-medium">{{ $product->created_at->format('F j, Y') }}</p>
                </div>
            </x-ui.card.card-content>
        </x-ui.card>

        <x-ui.card class="lg:col-span-2">
            <x-ui.card.card-header>
                <x-ui.card.card-title>Description</x-ui.card.card-title>
            </x-ui.card.card-header>
            <x-ui.card.card-content>
                <p class="text-sm text-muted-foreground">
                    {{ $product->description ?: 'No description provided yet.' }}
                </p>
            </x-ui.card.card-content>
        </x-ui.card>

        <x-ui.card class="lg:col-span-2">
            <x-ui.card.card-header>
                <x-ui.card.card-title>Variations</x-ui.card.card-title>
                <x-ui.card.card-description>{{ $product->variations_count }} variation(s)
                    available.</x-ui.card.card-description>
            </x-ui.card.card-header>
            <x-ui.card.card-content>
                @if ($product->variations->isEmpty())
                    <p class="text-sm text-muted-foreground">No variations have been added yet.</p>
                @else
                    <x-ui.item.item-group>
                        @foreach ($product->variations as $variation)
                            <x-ui.item.item variant="outline">
                                <x-ui.item.item-content>
                                    <x-ui.item.item-title>
                                        {{ $variation->name ?: ($variation->attributeValues->pluck('value')->implode(' / ') ?: 'Default') }}
                                    </x-ui.item.item-title>
                                    <x-ui.item.item-description>SKU: {{ $variation->sku }}</x-ui.item.item-description>
                                </x-ui.item.item-content>
                                <x-ui.item.item-actions>
                                    <span
                                        class="text-sm font-medium">K{{ number_format((float) $variation->price, 2) }}</span>
                                </x-ui.item.item-actions>
                            </x-ui.item.item>
                        @endforeach
                    </x-ui.item.item-group>
                @endif
            </x-ui.card.card-content>
        </x-ui.card>

        <x-ui.card>
            <x-ui.card.card-header>
                <x-ui.card.card-title>Attributes</x-ui.card.card-title>
            </x-ui.card.card-header>
            <x-ui.card.card-content>
                @if ($product->attributes->isEmpty())
                    <p class="text-sm text-muted-foreground">No attributes configured yet.</p>
                @else
                    <div class="space-y-4">
                        @foreach ($product->attributes as $attribute)
                            <div>
                                <p class="font-medium">{{ $attribute->name }}</p>
                                <div class="mt-2 flex flex-wrap gap-2">
                                    @foreach ($attribute->values as $value)
                                        <x-ui.badge :intent="App\Enums\Components\Button\Intent::Muted">
                                            {{ $value->value }}
                                        </x-ui.badge>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </x-ui.card.card-content>
        </x-ui.card>
    </div>
</x-admin.root>
