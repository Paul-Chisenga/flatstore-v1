@props(['brand'])

<x-ui.item.item variant="outline" class="bg-card">
    @if ($brand->logo_path)
        <x-ui.item.item-media variant="image" class="border">
            <img src="{{ route('download', ['file_path' => $brand->logo_path]) }}" alt="{{ $brand->name }}"
                class="object-contain" />
            {{-- <x-ui.avatar.avatar>
                <x-ui.avatar.avatar-image :src="$category->image_url" :alt="$category->name" />
                <x-ui.avatar.avatar-fallback>{{ Str::upper(Str::substr($category->name, 0, 2)) }}</x-ui.avatar.avatar-fallback>
            </x-ui.avatar.avatar> --}}
        </x-ui.item.item-media>
    @endif
    <x-ui.item.item-content>
        <x-ui.item.item-title>
            {{ $brand->name }}
        </x-ui.item.item-title>

        @if ($brand->description)
            <x-ui.item.item-description>
                {{ $brand->description }}
            </x-ui.item.item-description>
        @endif
    </x-ui.item.item-content>

    <x-ui.item.item-actions>
        <x-ui.button href="{{ route('admin.brands.edit', $brand) }}" :intent="App\Enums\Components\Button\Intent::Secondary"
            :size="App\Enums\Components\Button\Size::Xs">Edit</x-ui.button>
        <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')
            <x-ui.button type="submit" :variant="App\Enums\Components\Button\Variant::Ghost" :intent="App\Enums\Components\Button\Intent::Danger" :size="App\Enums\Components\Button\Size::Xs">Delete</x-ui.button>
        </form>
    </x-ui.item.item-actions>
</x-ui.item.item>
