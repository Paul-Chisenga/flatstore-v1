@props(['class' => $class ?? ''])

<h3 data-slot="card-title" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</h3>
