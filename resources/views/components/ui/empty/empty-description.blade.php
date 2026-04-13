@props(['class' => $class ?? ''])

<p data-slot="empty-description" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</p>
