@php
    use App\Enums\Components\Button\Intent;
    use App\Enums\Components\Button\Variant;
    use App\Enums\Components\Button\Size;
@endphp

<div class="">
    {{-- Header --}}
    <div class="flex gap-4 items-center">
        {{-- User info --}}
        <div class="flex min-w-0 flex-1 items-center gap-4">
            <div class="size-12 rounded-full bg-muted flex flex-col justify-center items-center">
                <IonIcon name="person" class="text-muted-foreground" />
            </div>
            <h1 class="min-w-0 flex-1 truncate text-base font-bold">John Does</h1>
        </div>
        {{-- Rating and Actions --}}
        <div class="flex items-center gap-1">
            <x-ui.badge :variant="Variant::Outline" :intent="Intent::Primary" class="rounded-full gap-1">
                <ion-icon name="star"></ion-icon>
                <span>4.5</span>
            </x-ui.badge>
        </div>
    </div>
    {{-- Body --}}
    <div class="py-2">
        <p class="line-clamp-2 text-sm text-muted-foreground">Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Ipsa blanditiis, ipsam in sequi provident
            consequatur, totam unde aliquid harum nobis quia incidunt inventore qui aperiam ipsum nesciunt debitis
            voluptatem magnam?</p>
    </div>
    {{-- Footer --}}
    <div class="flex items-center gap-4">
        <x-ui.button :variant="Variant::Link" :intent="Intent::Primary" :size="Size::Sm">
            <ion-icon name="heart" class="text-3xl"></ion-icon>
            <span>745</span>
        </x-ui.button>
        {{-- Date --}}
        <span class="text-xs text-muted-foreground">12 Aug 2023</span>
    </div>

</div>
