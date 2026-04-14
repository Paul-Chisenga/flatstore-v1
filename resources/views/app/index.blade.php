@php
    use App\Enums\Components\Button\Intent;
    use App\Enums\Components\Button\Variant;
    use App\Enums\Components\Button\Size;

    /**
     * @var \App\Dtos\Home\Product[] $popular_products
     * @var \App\Dtos\Home\Product[] $related_products
     * @var \App\Dtos\Home\Product[] $recent_products
     */

@endphp

<x-root>
    <div class="max-w-2xl mx-auto pb-6 px-4">
        {{-- Special offers section --}}
        <x-ui.section>
            <x-ui.section.header>
                <x-ui.section.title>Special Offers</x-ui.section.title>
                <x-ui.section.button>See All</x-ui.section.button>
            </x-ui.section.header>
            <x-ui.section.content>
                <x-cards.special-offer title="Today's special offer"
                    description="Get discount on every order, only valid for today" amount="30%"
                    productUrl="{{ Vite::asset('resources/images/offer-1.png') }}" />
            </x-ui.section.content>
        </x-ui.section>
        {{-- Categories section --}}
        <x-ui.section>
            <x-ui.section.header>
                <x-ui.section.title>Categories</x-ui.section.title>
                <x-ui.section.button>See All</x-ui.section.button>
            </x-ui.section.header>
            <x-ui.section.content class="grid grid-cols-4 gap-6">
                {{-- Row 1 --}}
                <x-home.category-box>
                    <x-slot:icon>
                        <ion-icon name="shirt"></ion-icon>
                    </x-slot:icon>
                    <x-slot:label>Clothing</x-slot:label>
                </x-home.category-box>
                <x-home.category-box>
                    <x-slot:icon>
                        <ion-icon name="phone-portrait"></ion-icon>
                    </x-slot:icon>
                    <x-slot:label>Electronics</x-slot:label>
                </x-home.category-box>
                <x-home.category-box>
                    <x-slot:icon>
                        <ion-icon name="home"></ion-icon>
                    </x-slot:icon>
                    <x-slot:label>Home</x-slot:label>
                </x-home.category-box>
                <x-home.category-box>
                    <x-slot:icon>
                        <ion-icon name="paw"></ion-icon>
                    </x-slot:icon>
                    <x-slot:label>Pets</x-slot:label>
                </x-home.category-box>
                <x-home.category-box>
                    <x-slot:icon>
                        <ion-icon name="watch"></ion-icon>
                    </x-slot:icon>
                    <x-slot:label>Accessories</x-slot:label>
                </x-home.category-box>
                <x-home.category-box>
                    <x-slot:icon>
                        <ion-icon name="restaurant"></ion-icon>
                    </x-slot:icon>
                    <x-slot:label>Food</x-slot:label>
                </x-home.category-box>
                <x-home.category-box>
                    <x-slot:icon>
                        <ion-icon name="game-controller"></ion-icon>
                    </x-slot:icon>
                    <x-slot:label>Gaming</x-slot:label>
                </x-home.category-box>
                <x-home.category-box>
                    <x-slot:icon>
                        <ion-icon name="fitness"></ion-icon>
                    </x-slot:icon>
                    <x-slot:label>Sports</x-slot:label>
                </x-home.category-box>
            </x-ui.section.content>
        </x-ui.section>
        {{-- Most Popular --}}
        <x-ui.section class="px-0">
            <x-ui.section.header class="px-4">
                <x-ui.section.title>Most Popular</x-ui.section.title>
                <x-ui.section.button>See All</x-ui.section.button>
            </x-ui.section.header>
            <x-ui.section.content>
                {{-- Filters --}}
                <div class="flex gap-4 overflow-x-auto mb-6 px-4">
                    <x-ui.button :intent="Intent::Primary" :size="Size::Sm">All</x-ui.button>
                    <x-ui.button :intent="Intent::Primary" :variant="Variant::Outline" :size="Size::Sm">Clothes</x-ui.button>
                    <x-ui.button :intent="Intent::Primary" :variant="Variant::Outline" :size="Size::Sm">Shoes</x-ui.button>
                    <x-ui.button :intent="Intent::Primary" :variant="Variant::Outline" :size="Size::Sm">Bags</x-ui.button>
                    <x-ui.button :intent="Intent::Primary" :variant="Variant::Outline" :size="Size::Sm">Electronics</x-ui.button>
                </div>
                {{-- Products grid --}}
                <div class="grid grid-cols-2 gap-4 px-4">
                    @foreach ($popular_products as $product)
                        <x-cards.product :product="$product" />
                    @endforeach
                </div>
            </x-ui.section.content>
        </x-ui.section>
        {{-- Stores --}}
        <x-ui.section class="px-0">
            <x-ui.section.header class="px-4">
                <x-ui.section.title>Stores</x-ui.section.title>
                <x-ui.section.button>See All</x-ui.section.button>
            </x-ui.section.header>

            <x-ui.section.content class="grid grid-cols-1 gap-4 bg-muted p-4">
                <x-cards.store name="Tech Store" tagline="Best gadgets in town"
                    logoUrl="https://dummyjson.com/icon/sophiab/128" productsUrl="#" detailsUrl="#" />
                <x-cards.store name="Fashion Hub" tagline="Trendy clothes for everyone"
                    logoUrl="https://dummyjson.com/icon/jamesd/128" productsUrl="#" detailsUrl="#" />
                <x-cards.store name="Home Essentials" tagline="Everything for your home"
                    logoUrl="https://dummyjson.com/icon/emmaj/128" productsUrl="#" detailsUrl="#" />
                <x-cards.store name="Pet Paradise" tagline="All you need for your pets"
                    logoUrl="https://dummyjson.com/icon/oliviaw/128" productsUrl="#" detailsUrl="#" />
            </x-ui.section.content>
        </x-ui.section>
        {{-- Related Products --}}
        <x-ui.section>
            <x-ui.section.header>
                <x-ui.section.title>Based on your previous search</x-ui.section.title>
            </x-ui.section.header>
            <x-ui.section.content>
                <div class="grid grid-cols-2 gap-4">
                    @foreach ($related_products as $product)
                        <x-cards.product :product="$product" />
                    @endforeach
                </div>
            </x-ui.section.content>
        </x-ui.section>
        {{-- Previous View --}}
        <x-ui.section>
            <x-ui.section.header>
                <x-ui.section.title>Recently viewed</x-ui.section.title>
                <x-ui.section.button>See All</x-ui.section.button>
            </x-ui.section.header>
            <x-ui.section.content>
                <div class="grid grid-cols-2 gap-4">
                    @foreach ($recent_products as $product)
                        <x-cards.product :product="$product" />
                    @endforeach
                </div>
            </x-ui.section.content>
        </x-ui.section>
    </div>
</x-root>
