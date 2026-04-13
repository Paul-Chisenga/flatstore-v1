@props(['class' => $class ?? ''])

<div data-slot="radio-group" role="radiogroup" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
