@props(['class' => $class ?? ''])

<div data-slot="field-content" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
