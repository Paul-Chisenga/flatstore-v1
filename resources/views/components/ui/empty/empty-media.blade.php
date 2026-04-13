@props([
    'variant' => $variant ?? 'default',
    'class' => $class ?? '',
])

<div data-slot="empty-media" data-variant="{{ $variant }}" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
