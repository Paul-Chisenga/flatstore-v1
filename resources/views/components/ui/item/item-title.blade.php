@props(['class' => $class ?? ''])

<p data-slot="item-title" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</p>
