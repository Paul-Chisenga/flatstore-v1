<a {{ $attributes->merge(['class' => 'active:opacity-75 transition-opacity duration-150']) }}>
    <x-ui.icon-box>
        <x-ui.icon-box.icon>
            {{ $icon }}
        </x-ui.icon-box.icon>
        <x-ui.icon-box.label>
            {{ $label }}
        </x-ui.icon-box.label>
    </x-ui.icon-box>
</a>
