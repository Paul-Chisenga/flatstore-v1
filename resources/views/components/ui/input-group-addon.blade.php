@props([
    'align' => 'inline-start',
])
<div
    role="group"
    data-slot="input-group-addon"
    data-align="{{ $align }}"
    {{ $attributes->merge(['class' => $classes()]) }}
>
    {{ $slot }}
</div>