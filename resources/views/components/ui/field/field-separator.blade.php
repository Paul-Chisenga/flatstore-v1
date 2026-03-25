@php
    $content = trim((string) $slot);
    $hasContent = $content !== '';
@endphp

@props(['class' => $class ?? ''])

<div data-slot="field-separator" data-content="{{ $hasContent ? 'true' : 'false' }}"
    {{ $attributes->merge(['class' => $class]) }}>
    <x-ui.separator class="absolute inset-0 top-1/2" />

    @if ($hasContent)
        <span class="text-muted-foreground px-2 relative mx-auto block w-fit bg-background"
            data-slot="field-separator-content">
            {{ $slot }}
        </span>
    @endif
</div>
