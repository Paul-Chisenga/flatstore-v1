@props(['class' => $class ?? ''])

<div data-slot="card-header" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
