@props(['class' => $class ?? ''])

<div data-slot="alert-action" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
