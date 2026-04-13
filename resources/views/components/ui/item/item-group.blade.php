@props(['class' => $class ?? ''])

<div data-slot="item-group" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
