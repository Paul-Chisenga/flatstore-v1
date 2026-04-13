@props(['class' => $class ?? ''])

<div data-slot="empty" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
