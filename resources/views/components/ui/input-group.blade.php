@props(['class' => $class ?? ''])

<div data-slot="input-group" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
