@php
    use App\Enums\Components\Button\Size;
    use App\Enums\Components\Button\Intent;
@endphp

@props(['title', 'imageUrl', 'price', 'rating'])

<a class="active:opacity-80 active:scale-[.98] transition-transform">
    {{-- Image Box --}}
    <div class="w-full aspect-square rounded-2xl bg-secondary relative overflow-hidden">
        <img src="{{ $imageUrl }}" alt="{{ $title }}" class="w-full h-full object-contain p-2">
        {{-- Add to wishlist --}}
        <x-ui.button class="absolute top-2 right-2 rounded-full dark" :size="Size::IconXs" :intent="Intent::Primary">
            <ion-icon name="heart-outline" class=""></ion-icon>
        </x-ui.button>
    </div>
    {{-- Title --}}
    <h3 class="font-bold mt-2 leading-4">{{ $title }}</h3>
    {{-- Rating --}}
    <div class="flex items-center gap-1 my-1">
        <ion-icon name="star-half-outline" class="text-warning"></ion-icon>
        <span class="text-sm text-secondary-foreground">{{ $rating }}</span>
    </div>
    {{-- Price --}}
    <span class="font-bold">K{{ $price }}</span>
</a>