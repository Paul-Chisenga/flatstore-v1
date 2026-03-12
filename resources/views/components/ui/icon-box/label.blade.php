@props(['class' => $class ?? ''])

<span {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</span>
