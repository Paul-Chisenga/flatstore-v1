@php
    use App\Enums\Components\Button\Intent;
    use App\Enums\Components\Button\Size;
    use App\Enums\Components\Button\Variant;
@endphp
@props([
    'variant' => Variant::Ghost->value,
    'size' => Size::Default->value,
    'intent' => Intent::Primary->value,
])
<button data-slot="button" data-variant="{{ $variant }}" data-size="{{ $size }}"
    data-intent="{{ $intent }}" {{ $attributes->merge(['class' => $classes()]) }}>
    {{ $slot }}
</button>
