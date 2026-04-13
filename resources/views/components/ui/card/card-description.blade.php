@props(['class' => $class ?? ''])

<p data-slot="card-description" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</p>
