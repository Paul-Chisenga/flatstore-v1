@props([
    'href' => $href ?? null,
    'class' => $class ?? '',
])

@if ($href)
    <a href="{{ $href }}" data-slot="breadcrumb-link"
        {{ $attributes->merge(['class' => 'transition-colors hover:text-foreground ' . $class]) }}>
        {{ $slot }}
    </a>
@else
    <span data-slot="breadcrumb-link" {{ $attributes->merge(['class' => $class]) }}>
        {{ $slot }}
    </span>
@endif
