@props(['class' => $class ?? ''])

<fieldset data-slot="field-set" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</fieldset>
