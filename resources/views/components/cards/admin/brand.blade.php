@props(['brand'])

<x-ui.item.item variant="outline" class="bg-card">
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
        <x-ui.button :intent="App\Enums\Components\Button\Intent::Secondary" :size="App\Enums\Components\Button\Size::Xs">Edit</x-ui.button>
        {{-- <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-primary">Edit</a> --}}
        <form action="" method="POST" class="inline-block">
            {{-- <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="inline-block"> --}}
            @csrf
            @method('DELETE')
            <x-ui.button :variant="App\Enums\Components\Button\Variant::Ghost" :intent="App\Enums\Components\Button\Intent::Danger" :size="App\Enums\Components\Button\Size::Xs">Delete</x-ui.button>
        </form>
    </x-ui.item.item-actions>
</x-ui.item.item>
