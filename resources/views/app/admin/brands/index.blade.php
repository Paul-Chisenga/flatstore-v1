<x-admin.root>
    <x-admin.page-header title="Brands" description="Manage your store's brands.">
        <x-ui.button class="ms-3" href="{{ route('admin.brands.create') }}">
            Create Brand
        </x-ui.button>
    </x-admin.page-header>
    @if (count($brands) === 0)
        <x-ui.empty.empty-state class="mt-8">
            <x-ui.empty.empty-header>
                No brands found
            </x-ui.empty.empty-header>
            <p class="text-muted-foreground">
                Get started by creating a new brand.
            </p>
            <x-ui.button class="mt-4" href="{{ route('admin.brands.create') }}">
                Create Brand
            </x-ui.button>
        </x-ui.empty.empty-state>
    @else
        <x-ui.item.item-group class="mt-8">
            @foreach ($brands as $brand)
                <x-cards.admin.brand :brand="$brand" />
            @endforeach
        </x-ui.item.item-group>
    @endif
</x-admin.root>
