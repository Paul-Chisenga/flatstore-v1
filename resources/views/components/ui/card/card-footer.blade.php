@props(['class' => $class ?? ''])

<div data-slot="card-footer" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
