@props(['class' => $class ?? ''])

<div data-slot="avatar-group" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
