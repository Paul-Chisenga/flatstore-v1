@props(['class' => $class ?? ''])

<div data-slot="alert-description" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
