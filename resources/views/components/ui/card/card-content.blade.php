@props(['class' => $class ?? ''])

<div data-slot="card-content" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
