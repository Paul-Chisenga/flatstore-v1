@props([
    'orientation' => $orientation ?? 'vertical',
    'class' => $class ?? '',
])

<div role="group" data-slot="field" data-orientation="{{ $orientation }}" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
