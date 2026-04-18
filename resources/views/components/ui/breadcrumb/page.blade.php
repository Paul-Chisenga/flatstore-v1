@props(['class' => $class ?? ''])

<span aria-current="page" aria-disabled="true" data-slot="breadcrumb-page"
    {{ $attributes->merge(['class' => 'text-foreground font-normal ' . $class]) }}>
    {{ $slot }}
</span>
