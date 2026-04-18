@php
    /** @var \App\Models\Store $store */

    $totalUnitsInStock = (int) ($store->total_units_in_stock ?? 0);
    $activeVariationsCount = (int) ($store->active_variations_count ?? 0);
@endphp

<x-admin.root>
    <x-admin.page-header title="{{ $store->name }}"
        description="View store details, inventory insights, and stock activity.">
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
                            href="{{ route('admin.sellers.show', $store->seller) }}">{{ $store->seller->name }}</x-ui.breadcrumb.link>
                    </x-ui.breadcrumb.item>
                    <x-ui.breadcrumb.separator />
                    <x-ui.breadcrumb.item>
                        <x-ui.breadcrumb.link
                            href="{{ route('admin.seller.stores', ['seller' => $store->seller]) }}">Stores</x-ui.breadcrumb.link>
                    </x-ui.breadcrumb.item>
                    <x-ui.breadcrumb.separator />
                    <x-ui.breadcrumb.item>
                        <x-ui.breadcrumb.page>{{ $store->name }}</x-ui.breadcrumb.page>
                    </x-ui.breadcrumb.item>
                </x-ui.breadcrumb.list>
            </x-ui.breadcrumb>
        </x-slot:breadcrumb>
        <div class="flex flex-wrap gap-3">
            <x-ui.button href="{{ route('admin.seller.products', ['seller' => $store->seller]) }}" :intent="App\Enums\Components\Button\Intent::Secondary">
                View Products
            </x-ui.button>
            <x-ui.button href="{{ route('admin.seller.stores.edit', ['seller' => $store->seller, 'store' => $store]) }}"
                :intent="App\Enums\Components\Button\Intent::Secondary">
                Edit Store
            </x-ui.button>
        </div>
    </x-admin.page-header>

    <div class="mt-8 grid gap-6 xl:grid-cols-3">
        <x-ui.card class="xl:col-span-3">
            <x-ui.card.card-header>
                <x-ui.card.card-title>Inventory Overview</x-ui.card.card-title>
                <x-ui.card.card-description>
                    Stock is created from product variations, then managed here for this store.
                </x-ui.card.card-description>
            </x-ui.card.card-header>
            <x-ui.card.card-content>
                <dl class="grid gap-4 sm:grid-cols-3">
                    <div class="rounded-xl border p-4">
                        <dt class="text-sm text-muted-foreground">Tracked SKUs</dt>
                        <dd class="mt-2 text-2xl font-semibold">{{ $store->products_count }}</dd>
                    </div>
                    <div class="rounded-xl border p-4">
                        <dt class="text-sm text-muted-foreground">Active Listings</dt>
                        <dd class="mt-2 text-2xl font-semibold">{{ $activeVariationsCount }}</dd>
                    </div>
                    <div class="rounded-xl border p-4">
                        <dt class="text-sm text-muted-foreground">Total Units</dt>
                        <dd class="mt-2 text-2xl font-semibold">{{ $totalUnitsInStock }}</dd>
                    </div>
                </dl>
            </x-ui.card.card-content>
        </x-ui.card>

        <x-ui.card class="pt-0 overflow-hidden">
            @if ($store->logo_path)
                <img src="{{ route('download', ['file_path' => $store->logo_path]) }}" alt="{{ $store->name }}"
                    class="h-40 w-full object-cover" />
            @else
                <div class="flex h-40 w-full items-center justify-center bg-muted">
                    <span class="text-3xl font-bold text-muted-foreground">
                        {{ Str::upper(Str::substr($store->name, 0, 2)) }}
                    </span>
                </div>
            @endif
            <x-ui.card.card-header>
                <x-ui.card.card-title>{{ $store->name }}</x-ui.card.card-title>
                <x-ui.card.card-description>
                    Seller: <a href="{{ route('admin.sellers.show', $store->seller_id) }}"
                        class="text-primary hover:underline">{{ $store->seller->name }}</a>
                </x-ui.card.card-description>
            </x-ui.card.card-header>
            <x-ui.card.card-content>
                <dl class="space-y-3 text-sm">
                    @if ($store->contact_email)
                        <div class="flex items-center justify-between gap-3">
                            <dt class="text-muted-foreground">Email</dt>
                            <dd>{{ $store->contact_email }}</dd>
                        </div>
                    @endif
                    @if ($store->phone_number)
                        <div class="flex items-center justify-between gap-3">
                            <dt class="text-muted-foreground">Phone</dt>
                            <dd>{{ $store->phone_number }}</dd>
                        </div>
                    @endif
                    <div class="flex items-center justify-between gap-3">
                        <dt class="text-muted-foreground">Tracked SKUs</dt>
                        <dd>{{ $store->products_count }}</dd>
                    </div>
                    <div class="flex items-center justify-between gap-3">
                        <dt class="text-muted-foreground">Joined</dt>
                        <dd>{{ $store->created_at->format('F j, Y') }}</dd>
                    </div>
                </dl>
            </x-ui.card.card-content>
        </x-ui.card>

        <x-ui.card>
            <x-ui.card.card-header>
                <x-ui.card.card-title>Address</x-ui.card.card-title>
            </x-ui.card.card-header>
            <x-ui.card.card-content>
                @if ($store->address)
                    <address class="space-y-1 text-sm not-italic">
                        <p>{{ $store->address->street }}</p>
                        <p>{{ $store->address->city }}, {{ $store->address->state }}
                            {{ $store->address->postal_code }}</p>
                        <p>{{ $store->address->country }}</p>
                    </address>
                @else
                    <p class="text-sm text-muted-foreground">No address on file.</p>
                @endif
            </x-ui.card.card-content>
        </x-ui.card>

        <x-ui.card>
            <x-ui.card.card-header>
                <x-ui.card.card-title>Shipping Methods</x-ui.card.card-title>
                <x-ui.card.card-description>
                    {{ $store->shippingMethods->count() }} method(s) configured
                </x-ui.card.card-description>
            </x-ui.card.card-header>
            <x-ui.card.card-content>
                @if ($store->shippingMethods->isNotEmpty())
                    <x-ui.item.item-group>
                        @foreach ($store->shippingMethods as $method)
                            <x-ui.item.item variant="outline">
                                <x-ui.item.item-content>
                                    <x-ui.item.item-title>{{ $method->name }}</x-ui.item.item-title>
                                </x-ui.item.item-content>
                            </x-ui.item.item>
                        @endforeach
                    </x-ui.item.item-group>
                @else
                    <p class="text-sm text-muted-foreground">No shipping methods configured.</p>
                @endif
            </x-ui.card.card-content>
        </x-ui.card>

        <x-ui.card class="xl:col-span-3">
            <x-ui.card.card-header>
                <x-ui.card.card-title>Inventory Management</x-ui.card.card-title>
                <x-ui.card.card-description>
                    Review, update, deactivate, or remove stock assignments for this store.
                </x-ui.card.card-description>
                <x-ui.card.card-action>
                    <x-ui.button href="{{ route('admin.seller.products', ['seller' => $store->seller]) }}"
                        :intent="App\Enums\Components\Button\Intent::Secondary" :size="App\Enums\Components\Button\Size::Sm">
                        Add from Variation
                    </x-ui.button>
                </x-ui.card.card-action>
            </x-ui.card.card-header>
            <x-ui.card.card-content>
                @if ($store->variationStocks->isEmpty())
                    <div class="rounded-xl border border-dashed p-6 text-sm text-muted-foreground">
                        This store has no variation stock yet. Start from a product variation, assign it to this store,
                        and then manage ongoing updates here.
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($store->variationStocks as $variationStock)
                            @php
                                $variation = $variationStock->productVariation;
                                $displayName =
                                    $variation?->name ?:
                                    ($variation?->attributeValues?->pluck('value')->implode(' / ') ?:
                                    $variation?->sku);
                            @endphp

                            <div class="rounded-xl border p-4">
                                <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                                    <div class="space-y-1">
                                        <p class="text-base font-semibold">
                                            {{ $variation?->product?->name ?? 'Product' }}</p>
                                        <p class="text-sm text-muted-foreground">
                                            {{ $displayName ?: 'Unnamed variation' }}</p>
                                        <div class="flex flex-wrap gap-2 text-xs text-muted-foreground">
                                            <span>SKU: {{ $variation?->sku ?? 'N/A' }}</span>
                                            <span>•</span>
                                            <span>
                                                Price:
                                                {{ $variation?->price !== null ? 'K' . number_format((float) $variation->price, 2) : 'Not set' }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex flex-wrap items-center gap-2">
                                        <x-ui.badge :intent="$variationStock->is_active
                                            ? App\Enums\Components\Button\Intent::Success
                                            : App\Enums\Components\Button\Intent::Muted">
                                            {{ $variationStock->is_active ? 'Active' : 'Inactive' }}
                                        </x-ui.badge>
                                        <x-ui.badge :intent="App\Enums\Components\Button\Intent::Info">
                                            {{ $variationStock->stock }} units
                                        </x-ui.badge>
                                        @if ($variation)
                                            <x-ui.button
                                                href="{{ route('admin.seller.product.variations.show', ['seller' => $store->seller, 'product' => $variation->product, 'variation' => $variation]) }}"
                                                :intent="App\Enums\Components\Button\Intent::Secondary" :size="App\Enums\Components\Button\Size::Sm">
                                                View Variation
                                            </x-ui.button>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-4 grid gap-3 lg:grid-cols-[minmax(0,1fr)_auto]">
                                    <form method="POST"
                                        action="{{ route('admin.seller.stores.stocks.update', ['seller' => $store->seller, 'store' => $store, 'variationStock' => $variationStock]) }}"
                                        class="space-y-3">
                                        @csrf
                                        @method('PUT')

                                        <div class="grid gap-3 md:grid-cols-[180px_auto_auto] md:items-end">
                                            <x-ui.field>
                                                <x-ui.field.field-label
                                                    for="stock_{{ $variationStock->id }}">Stock</x-ui.field.field-label>
                                                <x-ui.input id="stock_{{ $variationStock->id }}" name="stock"
                                                    type="number" min="0" :value="old('stock', $variationStock->stock)" />
                                                <x-ui.field.field-error :messages="$errors->get('stock')" />
                                            </x-ui.field>

                                            <x-ui.field>
                                                <x-ui.field.field-label
                                                    for="is_active_{{ $variationStock->id }}">Availability</x-ui.field.field-label>
                                                <label
                                                    class="flex h-10 items-center gap-2 rounded-xl border px-3 text-sm">
                                                    <input type="hidden" name="is_active" value="0">
                                                    <x-ui.checkbox id="is_active_{{ $variationStock->id }}"
                                                        name="is_active" value="1" :checked="(bool) old('is_active', $variationStock->is_active)" />
                                                    <span>Active in this store</span>
                                                </label>
                                                <x-ui.field.field-error :messages="$errors->get('is_active')" />
                                            </x-ui.field>

                                            <div class="flex flex-wrap gap-2">
                                                <x-ui.button type="submit">Save Changes</x-ui.button>
                                            </div>
                                        </div>
                                    </form>

                                    <form method="POST"
                                        action="{{ route('admin.seller.stores.stocks.destroy', ['seller' => $store->seller, 'store' => $store, 'variationStock' => $variationStock]) }}"
                                        onsubmit="return confirm('Remove this stock assignment from the store?')"
                                        class="flex items-end">
                                        @csrf
                                        @method('DELETE')
                                        <x-ui.button type="submit" :intent="App\Enums\Components\Button\Intent::Danger">Remove</x-ui.button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </x-ui.card.card-content>
        </x-ui.card>
    </div>
</x-admin.root>
