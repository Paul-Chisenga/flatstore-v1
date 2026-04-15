@props(['seller'])

@php
    /** @var App\Models\Seller $seller */
@endphp

<x-ui.item.item variant="outline" class="bg-card">
    <x-ui.item.item-media variant="image" class="w-20">
        <img src="{{ route('download', ['file_path' => $seller->logo_path]) }}" alt="{{ $seller->name }}"
            class="object-contain" />
    </x-ui.item.item-media>

    <x-ui.item.item-content>
        <x-ui.item.item-title>{{ $seller->name }}</x-ui.item.item-title>
        <x-ui.item.item-description>{{ $seller->business_email }}</x-ui.item.item-description>
        <div class="mt-1 flex items-center gap-2">
            <x-ui.badge :intent="App\Enums\Components\Button\Intent::Muted" class="capitalize">
                {{ $seller->type }}
            </x-ui.badge>
            <span class="text-xs text-muted-foreground">{{ $seller->products_count }} products</span>
            @if (count($seller->stores) > 0)
                <span class="text-xs text-muted-foreground">·
                    {{ implode(', ', $seller->stores->pluck('name')->toArray()) }}</span>
            @endif
        </div>
    </x-ui.item.item-content>

    <x-ui.item.item-actions>
        <span class="text-xs text-muted-foreground">{{ $seller->created_at->format('Y-m-d') }}</span>
        <x-ui.button href="{{ route('admin.sellers.show', $seller->id) }}" :intent="App\Enums\Components\Button\Intent::Secondary"
            :size="App\Enums\Components\Button\Size::Xs">View</x-ui.button>
    </x-ui.item.item-actions>
</x-ui.item.item>
