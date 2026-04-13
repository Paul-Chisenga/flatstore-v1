@props(['category'])

<x-ui.item.item variant="outline" class="bg-card">
    <x-ui.item.item-content>
        <div class="flex items-center space-x-4">
            <x-ui.item.item-media>
                <x-ui.avatar.avatar>
                    <x-ui.avatar.avatar-image :src="$category->image_url" :alt="$category->name" />
                    <x-ui.avatar.avatar-fallback>{{ Str::upper(Str::substr($category->name, 0, 2)) }}</x-ui.avatar.avatar-fallback>
                </x-ui.avatar.avatar>
            </x-ui.item.item-media>
            <div>
                <x-ui.item.item-title>
                    {{ $category->name }}
                </x-ui.item.item-title>
                @if ($category->description)
                    <x-ui.item.item-description>
                        {{ $category->description }}
                    </x-ui.item.item-description>
                @endif
                <a href="#"
                    class="text-sm text-muted-foreground underline hover:text-primary">{{ $category->products_count }}
                    products</a>
            </div>
        </div>
    </x-ui.item.item-content>

    <x-ui.item.item-actions>
        <x-ui.button :intent="App\Enums\Components\Button\Intent::Secondary" :size="App\Enums\Components\Button\Size::Xs">Edit</x-ui.button>
        {{-- <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary">Edit</a> --}}
        <form action="" method="POST" class="inline-block">
            {{-- <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block"> --}}
            @csrf
            @method('DELETE')
            <x-ui.button :variant="App\Enums\Components\Button\Variant::Ghost" :intent="App\Enums\Components\Button\Intent::Danger" :size="App\Enums\Components\Button\Size::Xs">Delete</x-ui.button>
        </form>
    </x-ui.item.item-actions>
</x-ui.item.item>
