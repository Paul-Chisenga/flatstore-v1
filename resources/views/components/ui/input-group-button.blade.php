@props([
    'variant' => 'ghost',
    'size' => 'xs',
    'intent' => 'muted',
])

@php
    use App\Enums\Components\Button\Intent;
    use App\Enums\Components\Button\Size;
    use App\Enums\Components\Button\Variant;

    $resolvedVariant = Variant::tryFrom($variant) ?? Variant::Ghost;
    $resolvedIntent = Intent::tryFrom($intent) ?? Intent::Muted;
    $resolvedSize = Size::tryFrom($size) ?? Size::Default;
@endphp

<x-ui.button type="button" :variant="$resolvedVariant" :intent="$resolvedIntent" :size="$resolvedSize"
    {{ $attributes->merge(['class' => $classes()]) }}>
    {{ $slot }}
</x-ui.button>
