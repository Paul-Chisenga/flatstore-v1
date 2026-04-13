@props(['title', 'description' => null, 'class' => $class ?? ''])

<x-ui.card data-slot="page-header"
    {{ $attributes->merge(['class' => twMerge('mb-4 border-none bg-transparent shadow-none ring-0', $class)]) }}>
    <x-ui.card.card-header>
        @if ($title)
            <x-ui.card.card-title class="text-2xl font-semibold tracking-tight md:text-2xl">
                {{ $title }}
            </x-ui.card.card-title>
        @endif
        @if ($description)
            <x-ui.card.card-description class="text-sm">{{ $description }}</x-ui.card.card-description>
        @endif
    </x-ui.card.card-header>
    @if ($slot->isNotEmpty())
        <x-ui.card.card-content>{{ $slot }}</x-ui.card.card-content>
    @endif
</x-ui.card>
