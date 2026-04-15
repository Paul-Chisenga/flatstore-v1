@props(['store'])

@php
    /** @var \App\Models\Store $store */
@endphp

<x-ui.card class="pt-0 overflow-hidden">
    @if ($store->logo_path)
        <img src="{{ route('download', ['file_path' => $store->logo_path]) }}" alt="{{ $store->name }}"
            class="h-36 w-full object-cover" />
    @else
        <div class="h-36 w-full bg-muted flex items-center justify-center">
            <span
                class="text-2xl font-bold text-muted-foreground">{{ Str::upper(Str::substr($store->name, 0, 2)) }}</span>
        </div>
    @endif
    <x-ui.card.card-header>
        <x-ui.card.card-description>{{ $store->seller->name }}</x-ui.card.card-description>
        <x-ui.card.card-title>{{ $store->name }}</x-ui.card.card-title>
        @if ($store->contact_email)
            <x-ui.card.card-description>{{ $store->contact_email }}</x-ui.card.card-description>
        @endif
        @if ($store->phone_number)
            <x-ui.card.card-action>
                <span class="text-xs text-muted-foreground">{{ $store->phone_number }}</span>
            </x-ui.card.card-action>
        @endif
    </x-ui.card.card-header>
    <x-ui.card.card-footer class="border-t">
        <x-ui.button href="{{ route('admin.stores.show', $store) }}" :intent="App\Enums\Components\Button\Intent::Secondary" :size="App\Enums\Components\Button\Size::Sm">
            View
        </x-ui.button>
        <x-ui.button href="{{ route('admin.stores.edit', $store) }}" :size="App\Enums\Components\Button\Size::Sm">
            Edit
        </x-ui.button>
    </x-ui.card.card-footer>
</x-ui.card>
