@php
    /**
     * @var string $type
     * @var string $variant
     * @var string $size
     * @var string $intent
     * @var string $class
     */
@endphp
@props([
    'type' => $type ?? 'button',
    'variant' => $variant ?? '',
    'size' => $size ?? '',
    'intent' => $intent ?? '',
    'class' => $class ?? '',
    'href' => $href ?? null,
])

@if ($href)
    <a href="{{ $href }}" data-slot="button" data-variant="{{ $variant }}" data-size="{{ $size }}"
        data-intent="{{ $intent }}" {{ $attributes->merge(['class' => $class]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" data-slot="button" data-variant="{{ $variant }}" data-size="{{ $size }}"
        data-intent="{{ $intent }}" {{ $attributes->merge(['class' => $class]) }}>
        {{ $slot }}
    </button>
@endif
