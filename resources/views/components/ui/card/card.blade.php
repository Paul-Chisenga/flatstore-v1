@props([
    'size' => $size ?? 'default',
    'class' => $class ?? '',
])

<div data-slot="card" data-size="{{ $size }}" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
