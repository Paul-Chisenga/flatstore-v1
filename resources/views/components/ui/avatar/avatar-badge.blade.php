@props(['class' => $class ?? ''])

<span data-slot="avatar-badge" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</span>
