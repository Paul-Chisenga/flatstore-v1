@php
    $categories = [];
@endphp

<x-admin.root>
    <x-admin.page-header title="Categories" description="Manage your store's categories.">
        <x-ui.button class="ms-3" href="{{ route('admin.categories.create') }}">
            Create Category
        </x-ui.button>
    </x-admin.page-header>
    @if (count($categories) === 0)
        <x-ui.empty.empty-state class="mt-8">
            <x-ui.empty.empty-header>
                No categories found
            </x-ui.empty.empty-header>
            <p class="text-muted-foreground">
                Get started by creating a new category.
            </p>
            <x-ui.button class="mt-4" href="{{ route('admin.categories.create') }}">
                Create Category
            </x-ui.button>
        </x-ui.empty.empty-state>
    @else
        <x-ui.item.item-group class="mt-8">
            @foreach ($categories as $category)
                <x-cards.admin.category :category="$category" />
            @endforeach
        </x-ui.item.item-group>
    @endif
</x-admin.root>
