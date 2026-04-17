@props(['seller'])

@php
    /** @var App\Models\Seller $seller */
@endphp

<x-ui.card class="pt-0 overflow-hidden">
    @if ($seller->logo_path)
        <img src="{{ route('download', ['file_path' => $seller->logo_path]) }}" alt="{{ $seller->name }}"
            class="h-36 w-full object-cover" />
    @else
        <div class="h-36 w-full bg-muted flex items-center justify-center">
            <span
                class="text-2xl font-bold text-muted-foreground">{{ Str::upper(Str::substr($seller->name, 0, 2)) }}</span>
        </div>
    @endif

    <x-ui.card.card-header>
        <x-ui.card.card-title>{{ $seller->name }}</x-ui.card.card-title>
        <x-ui.card.card-description>{{ $seller->business_email }}</x-ui.card.card-description>
        <x-ui.card.card-action>
            <x-ui.badge :intent="App\Enums\Components\Button\Intent::Muted" class="capitalize">
                {{ $seller->type->value ?? $seller->type }}
            </x-ui.badge>
        </x-ui.card.card-action>
    </x-ui.card.card-header>

    <x-ui.card.card-content>
        <div class="space-y-1 text-sm text-muted-foreground">
            <p>{{ $seller->products_count }} product(s)</p>
            <p>{{ $seller->stores->count() }} store(s)</p>
            @if ($seller->stores->isNotEmpty())
                <p>{{ $seller->stores->pluck('name')->take(2)->implode(', ') }}{{ $seller->stores->count() > 2 ? '...' : '' }}
                </p>
            @endif
        </div>
    </x-ui.card.card-content>

    <x-ui.card.card-footer class="border-t gap-4 flex items-center">
        <span class="text-xs text-muted-foreground">{{ $seller->created_at->format('Y-m-d') }}</span>
        <x-ui.button class="flex-1" href="{{ route('admin.sellers.show', $seller->id) }}" :intent="App\Enums\Components\Button\Intent::Secondary"
            :size="App\Enums\Components\Button\Size::Sm">
            View
        </x-ui.button>
    </x-ui.card.card-footer>
</x-ui.card>
