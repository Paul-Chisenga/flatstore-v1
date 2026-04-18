@php
    /** @var \App\Models\Store $store */
@endphp

<x-admin.root>
    <x-admin.page-header title="{{ $store->name }}" description="View store details and activity.">
        <x-ui.button href="{{ route('admin.seller.stores.edit', ['seller' => $store->seller, 'store' => $store]) }}"
            :intent="App\Enums\Components\Button\Intent::Secondary">
            Edit Store
        </x-ui.button>
    </x-admin.page-header>

    <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">

        {{-- Store details --}}
        <x-ui.card class="pt-0 overflow-hidden">
            @if ($store->logo_path)
                <img src="{{ route('download', ['file_path' => $store->logo_path]) }}" alt="{{ $store->name }}"
                    class="h-40 w-full object-cover" />
            @else
                <div class="h-40 w-full bg-muted flex items-center justify-center">
                    <span
                        class="text-3xl font-bold text-muted-foreground">{{ Str::upper(Str::substr($store->name, 0, 2)) }}</span>
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
                <dl class="space-y-2 text-sm">
                    @if ($store->contact_email)
                        <div class="flex items-center gap-2">
                            <dt class="text-muted-foreground">Email</dt>
                            <dd>{{ $store->contact_email }}</dd>
                        </div>
                    @endif
                    @if ($store->phone_number)
                        <div class="flex items-center gap-2">
                            <dt class="text-muted-foreground">Phone</dt>
                            <dd>{{ $store->phone_number }}</dd>
                        </div>
                    @endif
                    <div class="flex items-center gap-2">
                        <dt class="text-muted-foreground">Products</dt>
                        <dd>{{ $store->products_count }}</dd>
                    </div>
                    <div class="flex items-center gap-2">
                        <dt class="text-muted-foreground">Joined</dt>
                        <dd>{{ $store->created_at->format('F j, Y') }}</dd>
                    </div>
                </dl>
            </x-ui.card.card-content>
        </x-ui.card>

        {{-- Address --}}
        <x-ui.card>
            <x-ui.card.card-header>
                <x-ui.card.card-title>Address</x-ui.card.card-title>
            </x-ui.card.card-header>
            <x-ui.card.card-content>
                @if ($store->address)
                    <address class="not-italic space-y-1 text-sm">
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

        {{-- Shipping methods --}}
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

    </div>
</x-admin.root>
