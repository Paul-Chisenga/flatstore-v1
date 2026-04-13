@props(['class' => $class ?? ''])

<div data-slot="item-content" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
