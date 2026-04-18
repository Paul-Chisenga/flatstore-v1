@props(['class' => $class ?? ''])

<nav aria-label="breadcrumb" data-slot="breadcrumb" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</nav>
