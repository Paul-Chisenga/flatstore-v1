@props(['class' => $class ?? ''])

<ol data-slot="breadcrumb-list"
    {{ $attributes->merge(['class' => 'text-muted-foreground flex flex-wrap items-center gap-1.5 text-sm break-words sm:gap-2.5 ' . $class]) }}>
    {{ $slot }}
</ol>
