@props([
    'variant' => $variant ?? 'default',
    'class' => $class ?? '',
])

<div data-slot="alert" data-variant="{{ $variant }}" role="alert" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
