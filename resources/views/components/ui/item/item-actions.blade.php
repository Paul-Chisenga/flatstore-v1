@props(['class' => $class ?? ''])

<div data-slot="item-actions" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
