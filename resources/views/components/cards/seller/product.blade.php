{{-- Product card --}}

@props(['product', 'class' => $class ?? ''])

<x-ui.card class="pt-0 relative">
    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-48 w-full object-contain rounded">
    <x-ui.card.card-header>
        <x-ui.card.card-action>
            <x-ui.badge :intent="App\Enums\Components\Button\Intent::Success">
                Active
            </x-ui.badge>
        </x-ui.card.card-action>
        <x-ui.card.card-title>{{ $product->name }}</x-ui.card.card-title>
    </x-ui.card.card-header>
    <x-ui.card.card-content>
        <p class="text-sm text-muted-foreground">
            {{ Str::limit($product->description, 150) }}
        </p>
        <span class="text-lg font-semibold text-primary">${{ number_format($product->price, 2) }}</span>
    </x-ui.card.card-content>
    <x-ui.card.card-footer class="border-t">
        <x-ui.button href="{{ route('seller.products.edit', $product->id) }}" :size="App\Enums\Components\Button\Size::Sm">
            Edit
        </x-ui.button>
        <x-ui.button href="{{ route('seller.products.show', $product->id) }}" :size="App\Enums\Components\Button\Size::Sm" class="ms-2">
            View
        </x-ui.button>
    </x-ui.card.card-footer>
</x-ui.card>
