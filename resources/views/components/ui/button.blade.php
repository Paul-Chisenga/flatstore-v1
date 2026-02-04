@props([
    'variant' => 'default',
    'size' => 'default',
    'intent' => 'primary',
    'type' => 'button',
    'class' => '',
    'disabled' => false,
])

<button
    type="{{ $type }}"
    data-slot="button"
    data-variant="{{ $variant }}"
    data-size="{{ $size }}"
    data-intent="{{ $intent }}"
    @if($disabled) disabled @endif
    {{ $attributes->merge(['class' => $buttonClasses()]) }}
>
    {{ $slot }}
</button>
