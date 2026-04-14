@php
    use App\Enums\Components\Button\Size;
    use App\Enums\Components\Button\Intent;
    use App\Enums\Components\Button\Variant;

    $discountLabel = 'Flash Sale';
    $discountPercent = 35;
    $discountEndsAt = 'Mar 31, 2026 • 11:59 PM';
    $storeName = 'Tech Hub';
    $storeUrl = '#';
    $brandName = 'Apple';
    $brandUrl = '#';
    $categoryName = 'Smartphones';
    $categoryUrl = '#';

    /**
     * @var \App\Dtos\Products\Product $product
     * @var \App\Dtos\Home\Product[] $related_products
     */

@endphp

<x-root>
    <div class="max-w-2xl mx-auto">
        {{-- Image Box --}}
        <div id="product-container" class=" bg-muted min-h-64 max-h-80 overflow-hidden p-4">
            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full max-h-72 object-contain">
        </div>
        {{-- Content --}}
        <div class="py-6">
            {{-- Base Info --}}
            <div class="flex gap-16 px-4">
                <div class="flex-1">
                    {{-- Title --}}
                    <h3 class="text-2xl font-bold leading-4">{{ $product->name }}</h3>
                    {{-- Rating --}}
                    <div class="flex items-center gap-1 mt-2 mb-1">
                        <x-ui.badge :intent="Intent::Muted">
                            5 sold
                        </x-ui.badge>
                        <ion-icon name="star-half-outline" class="text-warning"></ion-icon>
                        <span class="text-sm text-muted-foreground">{{ $product->rating }}
                            (458 reviews)</span>
                    </div>
                    {{-- Shipping options --}}
                    <div class="flex items-center gap-4 mt-2">
                        <x-ui.badge :intent="Intent::Success">
                            express
                        </x-ui.badge>
                    </div>

                    {{-- Store metadata --}}
                    <div class="mt-3 flex flex-col gap-1 text-xs text-muted-foreground">
                        <span>
                            Store:
                            <a href="{{ $storeUrl }}" class="font-medium text-primary hover:underline">
                                {{ $storeName }}
                            </a>
                        </span>
                        <span>
                            Brand:
                            <a href="{{ $brandUrl }}" class="font-medium text-primary hover:underline">
                                {{ $brandName }}
                            </a>
                        </span>
                        <span>
                            Category:
                            <a href="{{ $categoryUrl }}" class="font-medium text-primary hover:underline">
                                {{ $categoryName }}
                            </a>
                        </span>
                    </div>
                </div>
                {{-- Actions --}}
                <div>
                    {{-- add to Wishlist --}}
                    <x-ui.button :size="Size::IconSm" :intent="Intent::Primary" :variant="Variant::Ghost" class="p-0 h-auto">
                        <ion-icon name="heart-outline" class="text-3xl"></ion-icon>
                    </x-ui.button>
                </div>
            </div>
            {{-- Divider --}}
            <x-ui.divider class="mt-3 h-2" />
            {{-- Variations and pricing --}}
            <div>
                <x-ui.section>
                    <x-ui.section.title class="px-4 text-base">Available variations</x-ui.section.title>
                    <x-ui.section.content class="flex items-center gap-4">
                        <div class="flex items-center gap-2 overflow-auto mb-2 px-4">
                            <x-ui.button type="button" :variant="Variant::Default" :intent="Intent::Primary" :size="Size::Xs">
                                variation 1
                            </x-ui.button>
                            <x-ui.button type="button" :intent="Intent::Muted" :size="Size::Xs">
                                variation 2
                            </x-ui.button>
                            <x-ui.button type="button" :intent="Intent::Muted" :size="Size::Xs">
                                variation 3
                            </x-ui.button>
                            <x-ui.button type="button" :intent="Intent::Muted" :size="Size::Xs">
                                variation 4
                            </x-ui.button>
                        </div>
                    </x-ui.section.content>
                </x-ui.section>
                {{-- Price and discount --}}
                <div class="py-4 space-y-2 bg-muted rounded px-4">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl font-bold text-foreground">k{{ $product->price }}</span>
                        <span class="text-sm line-through text-muted-foreground">K50</span>
                        <x-ui.badge :intent="Intent::Danger">
                            {{ $discountPercent }}% OFF
                        </x-ui.badge>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-muted-foreground">
                        <x-ui.badge :variant="Variant::Outline" :intent="Intent::Warning">
                            {{ $discountLabel }}
                        </x-ui.badge>
                        <span>Ends {{ $discountEndsAt }}</span>
                    </div>
                </div>

            </div>
            {{-- Description --}}
            <x-ui.section class="px-4">
                <x-ui.section.header>
                    <x-ui.section.title class="text-base">Description</x-ui.section.title>
                </x-ui.section.header>
                <x-ui.section.content>
                    <div>
                        <p class="text-sm text-muted-foreground line-clamp-3">
                            {{ $product->description }}
                        </p>
                        <x-ui.button type="button" :variant="Variant::Ghost" :intent="Intent::Primary" :size="Size::Xs"
                            class="mt-2 bg-muted">
                            Read More
                        </x-ui.button>
                    </div>
                </x-ui.section.content>
            </x-ui.section>
            <x-ui.divider class="mt-3 h-2" />
            {{-- Reviews --}}
            <x-ui.section class="px-4">
                <x-ui.section.header>
                    <x-ui.section.title class="text-base">Reviews</x-ui.section.title>
                    <x-ui.section.button>
                        See All
                    </x-ui.section.button>
                </x-ui.section.header>

                <x-ui.section.content>
                    <div class="flex flex-col gap-4">
                        <x-cards.review />
                        <x-cards.review />
                    </div>
                </x-ui.section.content>
            </x-ui.section>
            <x-ui.divider class="mt-3 h-2" />
            {{-- Related products --}}
            <x-ui.section class="px-4">
                <x-ui.section.header>
                    <x-ui.section.title class="text-base">Related Products</x-ui.section.title>
                    <x-ui.section.button>
                        See All
                    </x-ui.section.button>
                </x-ui.section.header>

                <x-ui.section.content class="grid grid-cols-2 gap-4">
                    @foreach ($related_products as $related_product)
                        <x-cards.product :product="$related_product" />
                    @endforeach
                </x-ui.section.content>
            </x-ui.section>

        </div>
    </div>
</x-root>
