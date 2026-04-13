@props(['class' => $class ?? ''])

<div data-slot="empty-header" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
