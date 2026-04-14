@props(['class' => $class ?? ''])

<div data-slot="alert-title" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
