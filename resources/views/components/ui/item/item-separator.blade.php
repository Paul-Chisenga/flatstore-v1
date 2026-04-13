@props(['class' => $class ?? ''])

<div data-slot="item-separator" role="separator" {{ $attributes->merge(['class' => $class]) }}></div>
