@props(['class' => $class ?? ''])

<x-ui.label data-slot="field-label" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</x-ui.label>
