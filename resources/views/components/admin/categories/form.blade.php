@props(['category' => null, 'parentCategory' => null])

@php
    $page_title = $category
        ? $category->name
        : ($parentCategory
            ? "Add Child Category for [{$parentCategory->name}]"
            : 'Create Category');
    $page_description = $category
        ? null
        : ($parentCategory
            ? 'Fill in the details below to create a new child category.'
            : 'Fill in the details below to create a new category.');
    $title = $category ? 'Edit Category' : ($parentCategory ? 'Create Child Category' : 'Create a new category');
    $description = $category
        ? 'Update the details of your category below.'
        : ($parentCategory
            ? 'Fill in the details below to create a new child category.'
            : 'Fill in the details below to create a new category.');
    $alert_title = $category ? 'Category Update Failed' : 'Category Creation Failed';
    $action = $category
        ? route('admin.categories.update', $category)
        : ($parentCategory
            ? route('admin.categories.store-child', $parentCategory)
            : route('admin.categories.store'));
    $submit_button_text = $category
        ? 'Update Category'
        : ($parentCategory
            ? 'Create Child Category'
            : 'Create Category');
@endphp

<x-admin.root>
    <x-admin.page-header title="{{ $page_title }}" description="{{ $page_description }}" />

    <x-ui.card class="mt-8">
        <x-ui.card.card-header>
            <x-ui.card.card-title>
                {{ $title }}
            </x-ui.card.card-title>
            <x-ui.card.card-description>
                {{ $description }}
            </x-ui.card.card-description>
            @error('error')
                <x-ui.alert.alert variant="destructive">
                    <x-ui.alert.alert-title>{{ $alert_title }}</x-ui.alert.alert-title>
                    <x-ui.alert.alert-description>
                        {{ $message }}
                    </x-ui.alert.alert-description>
                </x-ui.alert.alert>
            @enderror
        </x-ui.card.card-header>
        <x-ui.card.card-content>
            <form action="{{ $action }}" method="POST" class="space-y-6">
                @csrf
                @if ($category)
                    @method('PUT')
                @endif
                <x-ui.field.field>
                    <x-ui.field.field-label for="name">Name</x-ui.field.field-label>
                    <x-ui.input id="name" name="name" :value="old('name', $category?->name)" autofocus />
                    <x-ui.field.field-error :messages="$errors->get('name')" />
                </x-ui.field.field>
                <x-ui.field.field>
                    <x-ui.field.field-label for="description">Description</x-ui.field.field-label>
                    <x-ui.input id="description" name="description" :value="old('description', $category?->description)" />
                    <x-ui.field.field-error :messages="$errors->get('description')" />
                </x-ui.field.field>
                <x-ui.field.field>
                    <x-ui.field.field-label for="ionicon_name">Ionicon Name</x-ui.field.field-label>
                    <x-ui.input id="ionicon_name" name="ionicon_name" :value="old('ionicon_name', $category?->metadata['ionicon_name'] ?? null)" />
                    <x-ui.field.field-error :messages="$errors->get('ionicon_name')" />
                </x-ui.field.field>
                {{-- @if ($parentCategories->isNotEmpty())
                    <x-ui.field.field>
                        <x-ui.field.field-label for="parent_id">Parent Category</x-ui.field.field-label>
                        <x-ui.select id="parent_id" name="parent_id">
                            <option value="">None</option>
                            @foreach ($parentCategories as $parent)
                                <option value="{{ $parent->id }}" @selected(old('parent_id', $category?->parent_id) == $parent->id)>
                                    {{ $parent->name }}
                                </option>
                            @endforeach
                        </x-ui.select>
                        <x-ui.field.field-error :messages="$errors->get('parent_id')" />
                    </x-ui.field.field>
                @endif --}}
                <div class="flex justify-end">
                    <x-ui.button type="submit">
                        {{ $submit_button_text }}
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card.card-content>
    </x-ui.card>
</x-admin.root>
