@php
    /** @var \App\Models\Seller $seller */
    /** @var \App\Models\Product $product */
    /** @var \App\Models\ProductVariation $variation */

    $displayName = $variation->name ?: ($variation->attributeValues->pluck('value')->implode(' / ') ?: $variation->sku);
@endphp

<x-admin.root>
    <x-admin.page-header title="{{ $displayName }}" description="View this product variation and its configuration.">
        <x-ui.button class="ms-3"
            href="{{ route('admin.seller.product.variations.edit', ['seller' => $seller, 'product' => $product, 'variation' => $variation]) }}">
            Edit Variation
        </x-ui.button>
    </x-admin.page-header>

    <div class="mt-8 grid gap-6 lg:grid-cols-3">
        <x-ui.card>
            <x-ui.card.card-header>
                <x-ui.card.card-title>Variation Overview</x-ui.card.card-title>
                <x-ui.card.card-description>Core selling information.</x-ui.card.card-description>
            </x-ui.card.card-header>
            <x-ui.card.card-content class="space-y-4 text-sm">
                <div>
                    <p class="text-muted-foreground">Product</p>
                    <p class="font-medium">{{ $product->name }}</p>
                </div>
                <div>
                    <p class="text-muted-foreground">Seller</p>
                    <p class="font-medium">{{ $seller->name }}</p>
                </div>
                <div>
                    <p class="text-muted-foreground">SKU</p>
                    <p class="font-medium">{{ $variation->sku }}</p>
                </div>
                <div>
                    <p class="text-muted-foreground">Price</p>
                    <p class="font-medium">K{{ number_format((float) $variation->price, 2) }}</p>
                </div>
                <div>
                    <p class="text-muted-foreground">Default variation</p>
                    @if ($variation->is_default)
                        <x-ui.badge :intent="App\Enums\Components\Button\Intent::Success">Yes</x-ui.badge>
                    @else
                        <x-ui.badge :intent="App\Enums\Components\Button\Intent::Muted">No</x-ui.badge>
                    @endif
                </div>
                <div>
                    <p class="text-muted-foreground">Created</p>
                    <p class="font-medium">{{ $variation->created_at?->format('F j, Y') }}</p>
                </div>
            </x-ui.card.card-content>
        </x-ui.card>

        <x-ui.card class="lg:col-span-2">
            <x-ui.card.card-header>
                <x-ui.card.card-title>Selected Attribute Values</x-ui.card.card-title>
                <x-ui.card.card-description>The options that define this variation.</x-ui.card.card-description>
            </x-ui.card.card-header>
            <x-ui.card.card-content>
                @if ($variation->attributeValues->isEmpty())
                    <p class="text-sm text-muted-foreground">No attribute values are attached to this variation yet.</p>
                @else
                    <div class="flex flex-wrap gap-2">
                        @foreach ($variation->attributeValues as $attributeValue)
                            <x-ui.badge :intent="App\Enums\Components\Button\Intent::Muted">
                                {{ $attributeValue->attribute->name }}: {{ $attributeValue->value }}
                            </x-ui.badge>
                        @endforeach
                    </div>
                @endif
            </x-ui.card.card-content>
        </x-ui.card>

        <x-ui.card>
            <x-ui.card.card-header>
                <x-ui.card.card-title>Dimensions</x-ui.card.card-title>
                <x-ui.card.card-description>Shipping and packaging measurements.</x-ui.card.card-description>
            </x-ui.card.card-header>
            <x-ui.card.card-content class="space-y-4 text-sm">
                <div>
                    <p class="text-muted-foreground">Weight</p>
                    <p class="font-medium">{{ $variation->weight !== null ? $variation->weight : 'Not set' }}</p>
                </div>
                <div>
                    <p class="text-muted-foreground">Width</p>
                    <p class="font-medium">{{ $variation->width !== null ? $variation->width : 'Not set' }}</p>
                </div>
                <div>
                    <p class="text-muted-foreground">Height</p>
                    <p class="font-medium">{{ $variation->height !== null ? $variation->height : 'Not set' }}</p>
                </div>
                <div>
                    <p class="text-muted-foreground">Depth</p>
                    <p class="font-medium">{{ $variation->depth !== null ? $variation->depth : 'Not set' }}</p>
                </div>
            </x-ui.card.card-content>
        </x-ui.card>

        <x-ui.card class="lg:col-span-2">
            <x-ui.card.card-header>
                <x-ui.card.card-title>Store Availability</x-ui.card.card-title>
                <x-ui.card.card-description>Current stock assignments across stores.</x-ui.card.card-description>
            </x-ui.card.card-header>
            <x-ui.card.card-content>
                @if ($variation->stocks->isEmpty())
                    <p class="text-sm text-muted-foreground">No store stock has been assigned to this variation yet.</p>
                @else
                    <x-ui.item.item-group>
                        @foreach ($variation->stocks as $stock)
                            <x-ui.item.item variant="outline">
                                <x-ui.item.item-content>
                                    <x-ui.item.item-title>{{ $stock->store?->name ?? 'Store' }}</x-ui.item.item-title>
                                    <x-ui.item.item-description>
                                        Status: {{ $stock->is_active ? 'Active' : 'Inactive' }}
                                    </x-ui.item.item-description>
                                </x-ui.item.item-content>
                                <x-ui.item.item-actions>
                                    <x-ui.badge :intent="$stock->is_active ? App\Enums\Components\Button\Intent::Success : App\Enums\Components\Button\Intent::Muted">
                                        {{ $stock->stock }} in stock
                                    </x-ui.badge>
                                </x-ui.item.item-actions>
                            </x-ui.item.item>
                        @endforeach
                    </x-ui.item.item-group>
                @endif
            </x-ui.card.card-content>
        </x-ui.card>
    </div>
</x-admin.root>
