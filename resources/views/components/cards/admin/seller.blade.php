@props(['seller'])

<x-ui.item.item variant="outline" class="bg-card">
    <x-ui.item.item-media variant="avatar">
        <x-ui.avatar.avatar>
            <x-ui.avatar.avatar-fallback>{{ Str::upper(Str::substr($seller->name, 0, 2)) }}</x-ui.avatar.avatar-fallback>
        </x-ui.avatar.avatar>
    </x-ui.item.item-media>

    <x-ui.item.item-content>
        <x-ui.item.item-title>{{ $seller->name }}</x-ui.item.item-title>
        <x-ui.item.item-description>{{ $seller->email }}</x-ui.item.item-description>
        <div class="mt-1 flex items-center gap-2">
            <x-ui.badge :intent="App\Enums\Components\Button\Intent::Muted" class="capitalize">
                {{ $seller->store_type }}
            </x-ui.badge>
            <span class="text-xs text-muted-foreground">{{ $seller->products_count }} products</span>
            @if (count($seller->stores) > 0)
                <span class="text-xs text-muted-foreground">· {{ implode(', ', $seller->stores) }}</span>
            @endif
        </div>
    </x-ui.item.item-content>

    <x-ui.item.item-actions>
        <span class="text-xs text-muted-foreground">{{ $seller->created_at }}</span>
        <x-ui.button :intent="App\Enums\Components\Button\Intent::Secondary" :size="App\Enums\Components\Button\Size::Xs">View</x-ui.button>
    </x-ui.item.item-actions>
</x-ui.item.item>
