@php
    /**
     * @var string $name
     * @var string|null $tagline
     * @var string|null $logoUrl
     * @var string $productsUrl
     * @var string $detailsUrl
     */
@endphp
@props(['name', 'tagline' => null, 'logoUrl' => null, 'productsUrl' => '#', 'detailsUrl' => '#'])

<div {{ $attributes->merge(['class' => $class]) }}>
    {{-- Logo Box --}}
    <div
        class="size-21 overflow-hidden rounded-2xl border border-border bg-primary p-2 flex items-center justify-center">
        @if ($logoUrl)
            <img src="{{ $logoUrl }}" alt="{{ $name }}" class="h-full w-full object-contain">
        @else
            <span class="text-xs font-medium text-muted-foreground">No Logo</span>
        @endif
    </div>

    {{-- Content --}}
    <div class="flex min-w-0 flex-col gap-3">
        <div class="min-w-0">
            <h3 class="truncate text-base font-bold text-foreground">{{ $name }}</h3>
            @if ($tagline)
                <p class="mt-1 text-sm leading-5 text-muted-foreground">{{ $tagline }}</p>
            @endif
        </div>

        {{-- <div class="flex flex-wrap items-center gap-2">
            <x-ui.button type="button" :intent="Intent::Primary" :size="Size::Sm"
                onclick="window.location.assign(@js($productsUrl))">
                View Products
            </x-ui.button>
            <x-ui.button type="button" :intent="Intent::Primary" :variant="Variant::Outline" :size="Size::Sm"
                onclick="window.location.assign(@js($detailsUrl))">
                Company Details
            </x-ui.button>
        </div> --}}
    </div>
</div>
