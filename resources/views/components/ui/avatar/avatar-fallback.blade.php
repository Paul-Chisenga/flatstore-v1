@props(['class' => $class ?? ''])

<span data-slot="avatar-fallback" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</span>
