@php
    /**
     * @var string $title
     * @var string $description
     * @var string $amount
     * @var ?string $productUrl
     */
@endphp
@props(['title', 'description', 'amount', 'productUrl'])
<div class="flex gap-6 rounded-2xl bg-secondary p-6">
    {{-- Info --}}
    <div class="space-y-3 shrink-0 w-3/5">
        <h3 class="text-4xl font-bold">{{ $amount }}</h3>
        <h1 class="font-bold">{{ $title }}</h1>
        <p class="text-secondary-foreground text-xs">{{ $description }}</p>
    </div>
    {{-- Image --}}
    <div class="flex flex-col justify-center items-center">
        @if ($productUrl)
            <img src="{{ $productUrl }}" alt="{{ $title }}"
                class="w-full aspect-square object-contain rounded-2xl my-auto">
        @endif
    </div>
</div>
