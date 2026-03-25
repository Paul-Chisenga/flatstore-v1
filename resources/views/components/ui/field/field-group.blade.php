@props(['class' => $class ?? ''])

<div data-slot="field-group" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
