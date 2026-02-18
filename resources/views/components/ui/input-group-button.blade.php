@props([
    'variant' => 'ghost',
    'size' => 'xs',
    'intent' => 'muted',
])
<x-ui.button
    type="button"
    variant="{{ $variant }}"
    intent="{{ $intent }}"
    data-size="{{ $size }}"
    {{ $attributes->merge(['class' => $classes()]) }}
>
    {{ $slot }}
</x-ui.button>