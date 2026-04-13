@props(['class' => $class ?? ''])

<div data-slot="empty-content" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
