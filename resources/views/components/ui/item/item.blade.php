@props([
    'variant' => $variant ?? 'default',
    'size' => $size ?? 'default',
    'class' => $class ?? '',
])

<div data-slot="item" data-variant="{{ $variant }}" data-size="{{ $size }}"
    {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
