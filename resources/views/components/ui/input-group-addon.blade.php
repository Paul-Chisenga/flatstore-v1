@php
    /**
     * @var string $align
     * @var string $class
     */
@endphp
@props([
    'align' => $align ?? 'inline-start',
    'class' => $class ?? '',
])

<div role="group" data-slot="input-group-addon" data-align="{{ $align }}"
    {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
