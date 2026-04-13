@props(['class' => $class ?? ''])

<h3 data-slot="empty-title" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</h3>
