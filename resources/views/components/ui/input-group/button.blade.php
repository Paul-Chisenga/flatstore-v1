@php
    /**
     * @var \App\Enums\Components\Button\Variant $variant
     * @var \App\Enums\Components\Button\Intent $intent
     * @var \App\Enums\Components\Button\Size $size
     * @var string $class
     */
@endphp
@props([
    'variant' => $variant ?? null,
    'intent' => $intent ?? null,
    'size' => $size ?? null,
    'class' => $class ?? '',
])

<x-ui.button type="button" :variant="$variant" :intent="$intent" :size="$size"
    {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</x-ui.button>
