@props(['class' => $class ?? ''])

<p data-slot="item-description" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</p>
