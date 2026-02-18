@props([
    'variant' => 'default',
    'size' => 'default',
    'intent' => 'primary',
])
<button 
    data-slot="button" data-variant="{{ $variant }}" data-size="{{ $size }}" data-intent="{{ $intent }}"
    {{ $attributes->merge(['class' => $classes()]) }}
    >
    {{ $slot }}
</button>