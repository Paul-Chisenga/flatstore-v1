@php
    use App\Enums\Components\Button\Size;
    use App\Enums\Components\Button\Intent;

    /**
     * @var \App\Dtos\Home\Product $product
     */

@endphp

@props(['product'])

<a href="{{ route('products.show', ['id' => $product->id]) }}"
    class="active:opacity-80 active:scale-[.98] transition-transform">
    {{-- Image Box --}}
    <div class="w-full aspect-square rounded-2xl bg-secondary relative overflow-hidden">
        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-contain p-2">
        {{-- Add to wishlist --}}
        <x-ui.button class="absolute top-2 right-2 rounded-full" :size="Size::IconXs" :intent="Intent::Primary">
            <ion-icon name="heart-outline" class=""></ion-icon>
        </x-ui.button>
    </div>
    {{-- Title --}}
    <h3 class="font-bold mt-2 leading-4">{{ $product->name }}</h3>
    {{-- Rating --}}
    <div class="flex items-center gap-1 my-1">
        <ion-icon name="star-half-outline" class="text-warning"></ion-icon>
        <span class="text-sm text-secondary-foreground">{{ $product->rating }}</span>
    </div>
    {{-- Price --}}
    <span class="font-bold">K{{ $product->price }}</span>
</a>
