@php
    /** @var App\Models\Seller $seller */
@endphp

<x-admin.root>
    <x-admin.page-header title="{{ $seller->name }}" description="Manage the seller's details and settings.">
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
                        <x-ui.breadcrumb.page>{{ $seller->name }}</x-ui.breadcrumb.page>
                    </x-ui.breadcrumb.item>
                </x-ui.breadcrumb.list>
            </x-ui.breadcrumb>
        </x-slot:breadcrumb>
        <x-ui.button href="{{ route('admin.seller.stores.create', ['seller' => $seller]) }}" :intent="App\Enums\Components\Button\Intent::Secondary">
            Add Store
        </x-ui.button>
        <x-ui.button href="{{ route('admin.seller.products.create', ['seller' => $seller]) }}" :intent="App\Enums\Components\Button\Intent::Primary">
            Add Product
        </x-ui.button>
    </x-admin.page-header>

    <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">

        {{-- Business details --}}
        <x-ui.card class="pt-0 overflow-hidden">
            @if ($seller->logo_path)
                <img src="{{ route('download', ['file_path' => $seller->logo_path]) }}" alt="{{ $seller->name }}"
                    class="h-40 w-full object-cover" />
            @else
                <div class="h-40 w-full bg-muted flex items-center justify-center">
                    <span
                        class="text-3xl font-bold text-muted-foreground">{{ Str::upper(Str::substr($seller->name, 0, 2)) }}</span>
                </div>
            @endif
            <x-ui.card.card-header>
                <x-ui.card.card-title>{{ $seller->name }}</x-ui.card.card-title>
                <x-ui.card.card-description>{{ $seller->business_email }}</x-ui.card.card-description>
                <x-ui.card.card-action>
                    <x-ui.badge :intent="App\Enums\Components\Button\Intent::Info" class="capitalize">
                        {{ $seller->type->value }}
                    </x-ui.badge>
                </x-ui.card.card-action>
            </x-ui.card.card-header>
            <x-ui.card.card-content>
                <dl class="space-y-2 text-sm">
                    @if ($seller->phone)
                        <div class="flex items-center gap-2">
                            <dt class="text-muted-foreground">Phone</dt>
                            <dd>{{ $seller->phone }}</dd>
                        </div>
                    @endif
                    @if ($seller->description)
                        <div class="flex flex-col gap-1">
                            <dt class="text-muted-foreground">About</dt>
                            <dd>{{ $seller->description }}</dd>
                        </div>
                    @endif
                    <div class="flex items-center gap-2">
                        <dt class="text-muted-foreground">Products</dt>
                        <dd>{{ $seller->products_count }}</dd>
                    </div>
                </dl>
            </x-ui.card.card-content>
            <x-ui.card.card-footer class="border-t flex items-center justify-between gap-3">
                <p class="text-sm text-muted-foreground">Joined {{ $seller->created_at->format('F j, Y') }}</p>
                <x-ui.button href="{{ route('admin.seller.products', ['seller' => $seller]) }}" :intent="App\Enums\Components\Button\Intent::Secondary"
                    :size="App\Enums\Components\Button\Size::Sm">
                    View Products
                </x-ui.button>
            </x-ui.card.card-footer>
        </x-ui.card>

        {{-- Team --}}
        <x-ui.card>
            <x-ui.card.card-header>
                <x-ui.card.card-title>Team</x-ui.card.card-title>
                <x-ui.card.card-description>
                    {{ $seller->users->count() }} member(s)
                </x-ui.card.card-description>
            </x-ui.card.card-header>
            <x-ui.card.card-content>
                @if ($seller->users->isNotEmpty())
                    <x-ui.item.item-group>
                        @foreach ($seller->users as $user)
                            <x-ui.item.item variant="outline">
                                <x-ui.item.item-content>
                                    <x-ui.item.item-title>
                                        {{ $user->profile ? $user->profile->first_name . ' ' . $user->profile->last_name : $user->email }}
                                    </x-ui.item.item-title>
                                    <x-ui.item.item-description>{{ $user->email }}</x-ui.item.item-description>
                                </x-ui.item.item-content>
                                <x-ui.item.item-actions>
                                    <x-ui.badge :intent="App\Enums\Components\Button\Intent::Muted" class="capitalize">
                                        {{ $user->pivot->role->label() }}
                                    </x-ui.badge>
                                </x-ui.item.item-actions>
                            </x-ui.item.item>
                        @endforeach
                    </x-ui.item.item-group>
                @else
                    <p class="text-sm text-muted-foreground">No team members yet.</p>
                @endif
            </x-ui.card.card-content>
        </x-ui.card>

        {{-- Stores --}}
        <x-ui.card>
            <x-ui.card.card-header>
                <x-ui.card.card-title>Stores</x-ui.card.card-title>
                <x-ui.card.card-description>
                    {{ $seller->stores->count() }} store(s)
                </x-ui.card.card-description>
                <x-ui.card.card-action>
                    <x-ui.button href="{{ route('admin.seller.stores', ['seller' => $seller]) }}" :intent="App\Enums\Components\Button\Intent::Secondary"
                        :size="App\Enums\Components\Button\Size::Sm">
                        View All
                    </x-ui.button>
                </x-ui.card.card-action>
            </x-ui.card.card-header>
            <x-ui.card.card-content>
                @if ($seller->stores->isNotEmpty())
                    <div class="grid gap-4 sm:grid-cols-2">
                        @foreach ($seller->stores as $store)
                            <x-cards.seller.store :store="$store" />
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-muted-foreground">No stores yet.</p>
                @endif
            </x-ui.card.card-content>
        </x-ui.card>

    </div>
</x-admin.root>
