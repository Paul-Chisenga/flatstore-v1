@props(['class' => $class ?? ''])

<li role="presentation" aria-hidden="true" data-slot="breadcrumb-separator"
    {{ $attributes->merge(['class' => 'text-muted-foreground/70 ' . $class]) }}>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3.5">
        <path fill-rule="evenodd"
            d="M7.22 14.78a.75.75 0 0 1 0-1.06L10.94 10 7.22 6.28a.75.75 0 1 1 1.06-1.06l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0Z"
            clip-rule="evenodd" />
    </svg>
</li>
