@props(['class' => $class ?? ''])

<div data-slot="item-footer" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
