@props(['class' => $class ?? ''])

<p data-slot="field-description" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</p>
