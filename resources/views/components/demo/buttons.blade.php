@php
    use App\Enums\Components\Button\Intent;
    use App\Enums\Components\Button\Size;
    use App\Enums\Components\Button\Variant;
@endphp

<div class="flex flex-col gap-4">
    <x-ui.button :intent="Intent::Primary">
        <ion-icon name="heart"></ion-icon>
        Primary Button
    </x-ui.button>

    <x-ui.button :intent="Intent::Success">
        Success Outline
    </x-ui.button>

    <x-ui.button :intent="Intent::Primary" :size="Size::Icon">
        <ion-icon name="cart"></ion-icon>
    </x-ui.button>

    <x-ui.button :intent="Intent::Info" :variant="Variant::Link">
        Info Link
    </x-ui.button>

    <x-ui.button :intent="Intent::Muted">
        Muted Button
    </x-ui.button>

    <x-ui.button :intent="Intent::Secondary">
        <ion-icon name="check"></ion-icon>
        Secondary Button
    </x-ui.button>
</div>
