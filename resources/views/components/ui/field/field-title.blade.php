@props(['class' => $class ?? ''])

<div data-slot="field-label" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
