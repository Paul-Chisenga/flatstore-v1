@props([
    'variant' => $variant ?? 'default',
    'class' => $class ?? '',
])

<div data-slot="item-media" data-variant="{{ $variant }}" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
