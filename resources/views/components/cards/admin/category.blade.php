@props(['category'])

<div x-data="{ open: false }">
    <x-ui.item variant="outline" class="bg-card">
        <x-ui.button class="shrink-0" @click="open = !open" :variant="App\Enums\Components\Button\Variant::Default" :intent="App\Enums\Components\Button\Intent::Secondary" :size="App\Enums\Components\Button\Size::IconSm">
            <ion-icon name="chevron-down-outline" x-show="!open"></ion-icon>
            <ion-icon name="chevron-up-outline" x-show="open"></ion-icon>
        </x-ui.button>
        @if ($category->metadata['ionicon_name'] ?? null)
            <x-ui.item.item-media variant="icon">

                <ion-icon name="{{ $category->metadata['ionicon_name'] }}" class="size-6"></ion-icon>

                {{-- <x-ui.avatar.avatar>
                <x-ui.avatar.avatar-image :src="$category->image_url" :alt="$category->name" />
                <x-ui.avatar.avatar-fallback>{{ Str::upper(Str::substr($category->name, 0, 2)) }}</x-ui.avatar.avatar-fallback>
            </x-ui.avatar.avatar> --}}
            </x-ui.item.item-media>
        @endif
        <x-ui.item.item-content>
            <x-ui.item.item-title>
                {{ $category->name }}
            </x-ui.item.item-title>
            @if ($category->description)
                <x-ui.item.item-description>
                    {{ $category->description }}
                </x-ui.item.item-description>
            @endif
            <a href="#"
                class="text-sm text-muted-foreground underline hover:text-primary">{{ count($category->products) }}
                products</a>
        </x-ui.item.item-content>
        <x-ui.item.item-actions>
            <x-ui.button href="{{ route('admin.categories.create-child', $category) }}" :intent="App\Enums\Components\Button\Intent::Secondary"
                :size="App\Enums\Components\Button\Size::IconSm">
                <ion-icon name="add-outline"></ion-icon>
            </x-ui.button>
            <x-ui.button href="{{ route('admin.categories.edit', $category) }}" :intent="App\Enums\Components\Button\Intent::Secondary" :size="App\Enums\Components\Button\Size::IconSm">
                <ion-icon name="create-outline"></ion-icon>
            </x-ui.button>
            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <x-ui.button type="submit" :intent="App\Enums\Components\Button\Intent::Danger" :size="App\Enums\Components\Button\Size::IconSm">
                    <ion-icon name="close-outline"></ion-icon>
                </x-ui.button>
            </form>
        </x-ui.item.item-actions>
    </x-ui.item>
    <div x-show="open" class="mt-4 border rounded-xl p-4 ">
        @foreach ($category->children as $category)
            <x-cards.admin.category :category="$category" />
        @endforeach
    </div>
</div>
