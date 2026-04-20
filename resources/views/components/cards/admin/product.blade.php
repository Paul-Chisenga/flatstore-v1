@props(['product'])

@php
    /** @var \App\Models\Product $product */
@endphp

<x-ui.card class="pt-0 overflow-hidden">

    @if ($product->thumbnail_path)
        <img src="{{ route('download', ['file_path' => $product->thumbnail_path]) }}" alt="{{ $product->name }} thumbnail"
            class="h-36 w-full object-cover bg-muted" />
    @else
        <div class="flex h-36 w-full items-center justify-center bg-muted">
            <span
                class="text-2xl font-bold text-muted-foreground">{{ Str::upper(Str::substr($product->name, 0, 2)) }}</span>
        </div>
    @endif

    <x-ui.card.card-header>
        <x-ui.card.card-description>{{ $product->seller->name }}</x-ui.card.card-description>
        <x-ui.card.card-title>{{ $product->name }}</x-ui.card.card-title>
        @if ($product->brand)
            <x-ui.card.card-description>{{ $product->brand->name }}</x-ui.card.card-description>
        @endif
        <x-ui.card.card-action>
            <x-ui.badge :intent="$product->status?->value === App\Enums\ProductStatus::Published->value
                ? App\Enums\Components\Button\Intent::Success
                : App\Enums\Components\Button\Intent::Muted">
                {{ $product->status?->label() ?? ucfirst((string) $product->status) }}
            </x-ui.badge>
        </x-ui.card.card-action>
    </x-ui.card.card-header>

    <x-ui.card.card-content>
        <div class="flex flex-wrap gap-2">
            @foreach ($product->categories as $category)
                <x-ui.badge :intent="App\Enums\Components\Button\Intent::Info">
                    {{ $category->name }}
                </x-ui.badge>
            @endforeach
        </div>
        <p class="mt-3 text-sm text-muted-foreground">
            {{ $product->variations_count }} variation(s)
        </p>
    </x-ui.card.card-content>

    <x-ui.card.card-footer class="border-t">
        <x-ui.button
            href="{{ route('admin.seller.products.show', ['seller' => $product->seller, 'product' => $product]) }}"
            :intent="App\Enums\Components\Button\Intent::Secondary" :size="App\Enums\Components\Button\Size::Sm">
            View
        </x-ui.button>
        <x-ui.button
            href="{{ route('admin.seller.products.edit', ['seller' => $product->seller, 'product' => $product]) }}"
            :size="App\Enums\Components\Button\Size::Sm">
            Edit
        </x-ui.button>
    </x-ui.card.card-footer>
</x-ui.card>
