@props([
    'variant' => $variant ?? 'legend',
    'class' => $class ?? '',
])

<legend data-slot="field-legend" data-variant="{{ $variant }}" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</legend>
