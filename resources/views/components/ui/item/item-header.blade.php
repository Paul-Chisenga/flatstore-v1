@props(['class' => $class ?? ''])

<div data-slot="item-header" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
