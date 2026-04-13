@props([
    'size' => $size ?? 'default',
    'class' => $class ?? '',
])

<span data-slot="avatar" data-size="{{ $size }}" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</span>
