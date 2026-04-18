@props(['class' => $class ?? ''])

<li data-slot="breadcrumb-item" {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 ' . $class]) }}>
    {{ $slot }}
</li>
