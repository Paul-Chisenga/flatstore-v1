@props(['seller'])

<x-ui.card>
    <x-ui.card.card-header>
        <x-ui.badge :intent="App\Enums\Components\Button\Intent::Success">
            Active
        </x-ui.badge>
        <x-ui.card.card-title>{{ $seller->name }}</x-ui.card.card-title>
        <x-ui.card.card-description>{{ implode(', ', (array) $seller->stores) }}</x-ui.card.card-description>
    </x-ui.card.card-header>
    <x-ui.card.card-content>
        <p><strong>Joined:</strong> {{ $seller->created_at->format('M d, Y') }}</p>
        <p><strong>Total Stores:</strong> {{ count((array) $seller->stores) }}</p>
        <p><strong>Total Products:</strong> {{ $seller->products_count }}</p>
    </x-ui.card.card-content>
    <x-ui.card.card-footer class="border-t">
        <x-ui.button class="w-full">
            View Details
        </x-ui.button>
    </x-ui.card.card-footer>
</x-ui.card>
