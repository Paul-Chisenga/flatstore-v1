@php
    /**
     * @var string $variant
     * @var string $intent
     * @var string $class
     */
@endphp
@props([
    'variant' => $variant ?? '',
    'intent' => $intent ?? '',
    'class' => $class ?? '',
])

<span data-slot="badge" data-variant="{{ $variant }}" data-intent="{{ $intent }}"
    {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</span>
