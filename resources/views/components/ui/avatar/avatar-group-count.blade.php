@props(['class' => $class ?? ''])

<span data-slot="avatar-group-count" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</span>
