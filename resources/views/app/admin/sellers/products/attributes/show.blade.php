@php
    /** @var \App\Models\Seller $seller */
    /** @var \App\Models\Product $product */
    /** @var \App\Models\ProductAttribute $attribute */

    $linkedVariations = $attribute->values->flatMap(static fn($value) => $value->variations)->unique('id')->values();
@endphp

<x-admin.root>
    <x-admin.page-header title="{{ $attribute->name }}"
        description="View this product attribute and its configured values.">
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
                        <x-ui.breadcrumb.page>{{ $attribute->name }}</x-ui.breadcrumb.page>
                    </x-ui.breadcrumb.item>
                </x-ui.breadcrumb.list>
            </x-ui.breadcrumb>
        </x-slot:breadcrumb>
        <x-ui.button class="ms-3"
            href="{{ route('admin.seller.product.attributes.edit', ['seller' => $seller, 'product' => $product, 'attribute' => $attribute]) }}">
            Edit Attribute
        </x-ui.button>
    </x-admin.page-header>

    <div class="mt-8 grid gap-6 lg:grid-cols-3">
        <x-ui.card>
            <x-ui.card.card-header>
                <x-ui.card.card-title>Attribute Overview</x-ui.card.card-title>
                <x-ui.card.card-description>Basic configuration details.</x-ui.card.card-description>
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
                    <p class="text-muted-foreground">Values</p>
                    <p class="font-medium">{{ $attribute->values->count() }}</p>
                </div>
                <div>
                    <p class="text-muted-foreground">Used in variations</p>
                    <p class="font-medium">{{ $linkedVariations->count() }}</p>
                </div>
                <div>
                    <p class="text-muted-foreground">Created</p>
                    <p class="font-medium">{{ $attribute->created_at?->format('F j, Y') }}</p>
                </div>
            </x-ui.card.card-content>
        </x-ui.card>

        <x-ui.card class="lg:col-span-2">
            <x-ui.card.card-header>
                <x-ui.card.card-title>Attribute Values</x-ui.card.card-title>
                <x-ui.card.card-description>All values available for this attribute.</x-ui.card.card-description>
            </x-ui.card.card-header>
            <x-ui.card.card-content>
                @if ($attribute->values->isEmpty())
                    <p class="text-sm text-muted-foreground">No values have been added to this attribute yet.</p>
                @else
                    <div class="flex flex-wrap gap-2">
                        @foreach ($attribute->values as $value)
                            <x-ui.badge :intent="App\Enums\Components\Button\Intent::Muted">
                                {{ $value->value }}
                            </x-ui.badge>
                        @endforeach
                    </div>
                @endif
            </x-ui.card.card-content>
        </x-ui.card>

        <x-ui.card class="lg:col-span-3">
            <x-ui.card.card-header>
                <x-ui.card.card-title>Linked Variations</x-ui.card.card-title>
                <x-ui.card.card-description>Variations currently using one of these values.</x-ui.card.card-description>
            </x-ui.card.card-header>
            <x-ui.card.card-content>
                @if ($linkedVariations->isEmpty())
                    <p class="text-sm text-muted-foreground">No variations are linked to this attribute yet.</p>
                @else
                    <x-ui.item.item-group>
                        @foreach ($linkedVariations as $variation)
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
                                    <x-ui.button
                                        href="{{ route('admin.seller.product.variations.show', ['seller' => $seller, 'product' => $product, 'variation' => $variation]) }}"
                                        :intent="App\Enums\Components\Button\Intent::Info" :size="App\Enums\Components\Button\Size::Sm">
                                        View
                                    </x-ui.button>
                                </x-ui.item.item-actions>
                            </x-ui.item.item>
                        @endforeach
                    </x-ui.item.item-group>
                @endif
            </x-ui.card.card-content>
        </x-ui.card>
    </div>
</x-admin.root>
