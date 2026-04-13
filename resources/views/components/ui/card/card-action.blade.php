@props(['class' => $class ?? ''])

<div data-slot="card-action" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
