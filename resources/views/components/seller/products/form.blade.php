@props(['seller', 'brands', 'categories', 'product' => null])

@php
    /** @var App\Models\Brand[] $brands */
    /** @var App\Models\Category[] $categories */
    /** @var App\Models\Product|null $product */
    /** @var App\Models\Seller $seller */

    $brand_id = old('brand_id') ?? $product?->brand_id;
    $selectedCategoryIds = collect(old('category_ids', $product?->categories?->pluck('id')->all() ?? []))
        ->map(static fn($id) => (int) $id)
        ->all();
    $action = $product
        ? route('admin.seller.products.update', ['seller' => $product->seller, 'product' => $product])
        : route('admin.seller.products.store', ['seller' => $seller]);
    $method = $product ? 'PUT' : 'POST';
    $title = $product ? 'Edit Product' : 'Create Product';
    $description = $product
        ? 'Edit the details of your product.'
        : 'Fill in the details below to create a new product.';
@endphp

<x-admin.root>
    <x-admin.page-header title="{{ $title }}" description="{{ $description }}" />
    <form action="{{ $action }}" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @if ($method === 'PUT')
            @method('PUT')
        @endif
        <x-ui.card class="mt-8">
            <x-ui.card.card-header>
                <x-ui.card.card-title>
                    {{ $title }}
                </x-ui.card.card-title>
                <x-ui.card.card-description>
                    {{ $description }}
                </x-ui.card.card-description>
                {{-- Error --}}
                @error('error')
                    <x-ui.alert.alert variant="destructive">
                        <x-ui.alert.alert-title>{{ 'Product Creation Failed' }}</x-ui.alert.alert-title>
                        <x-ui.alert.alert-description>
                            {{ $message }}
                        </x-ui.alert.alert-description>
                    </x-ui.alert.alert>
                @enderror
            </x-ui.card.card-header>
            <x-ui.card.card-content>
                <x-ui.field.field-group class="grid grid-cols-2 gap-6">
                    <x-ui.field.field-set>
                        <x-ui.field>
                            <x-ui.field.field-label for="brand_id">Brand</x-ui.field.field-label>
                            <x-ui.select id="brand_id" name="brand_id">
                                <option value="">Select a brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $brand_id == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </x-ui.select>
                            <x-ui.field.field-error :messages="$errors->get('brand_id')" />
                        </x-ui.field>
                        <x-ui.field.field-set>
                            <x-ui.field.field-label for="category_ids">Categories</x-ui.field.field-label>
                            <x-ui.field.field-group>
                                @foreach ($categories as $category)
                                    <x-ui.field orientation="horizontal">
                                        <x-ui.checkbox id="category_ids_{{ $category->id }}" name="category_ids[]"
                                            value="{{ $category->id }}" :checked="in_array($category->id, $selectedCategoryIds, true)" />
                                        <x-ui.field.field-label for="category_ids_{{ $category->id }}">
                                            {{ $category->name }}
                                        </x-ui.field.field-label>
                                    </x-ui.field>
                                @endforeach
                            </x-ui.field.field-group>
                            <x-ui.field.field-error :messages="$errors->get('category_ids')" />
                        </x-ui.field.field-set>
                    </x-ui.field.field-set>
                    <x-ui.field.field-set>
                        <x-ui.field.field-group>
                            <x-ui.field>
                                <x-ui.field.field-label for="name">Product Name</x-ui.field.field-label>
                                <x-ui.input id="name" name="name" type="text" :value="old('name', $product?->name ?? '43 Iches Samsung Tv with 4K resolution')"
                                    placeholder="Eg. Sample Product" />
                                <x-ui.field.field-error :messages="$errors->get('name')" />
                            </x-ui.field>
                            <x-ui.field>
                                <x-ui.field.field-label for="description">Description
                                    (optional)</x-ui.field.field-label>
                                <x-ui.textarea id="description" name="description"
                                    placeholder="Eg. Sample Product Description">
                                    {{ old('description', $product?->description ?? '43 Inches Samsung TV with 4K resolution') }}
                                </x-ui.textarea>
                                <x-ui.field.field-error :messages="$errors->get('description')" />
                            </x-ui.field>
                        </x-ui.field.field-group>
                    </x-ui.field.field-set>
                </x-ui.field.field-group>
            </x-ui.card.card-content>
            <x-ui.card.card-footer class="justify-end">
                <x-ui.button type="submit">
                    {{ $title }}
                </x-ui.button>
            </x-ui.card.card-footer>
        </x-ui.card>
    </form>
</x-admin.root>
