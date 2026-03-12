@php
    /**
     * @var mixed $icon
     * @var mixed $label
     */
@endphp
@props(['icon', 'label', 'class' => $class ?? ''])

<a {{ $attributes->merge(['class' => $class]) }}>
    <x-ui.icon-box>
        <x-ui.icon-box.icon>
            {{ $icon }}
        </x-ui.icon-box.icon>
        <x-ui.icon-box.label>
            {{ $label }}
        </x-ui.icon-box.label>
    </x-ui.icon-box>
</a>
