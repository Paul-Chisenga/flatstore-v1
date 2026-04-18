@props([
    'action',
    'title',
    'description',
    'product',
    'alert_title' => null,
    'alert_description' => null,
    'submit_label' => null,
    'variation' => null,
])

@php
    /** @var App\Models\Product $product */
    /** @var App\Models\ProductVariation|null $variation */

    $selectedAttributeValueIds = collect(
        old('attribute_value_ids', $variation?->attributeValues?->pluck('id')->all() ?? []),
    )
        ->map(static fn($id) => (int) $id)
        ->all();
@endphp

<x-common.form-card :isEdit="$variation !== null" :action="$action" :title="$title" :description="$description" :alert_title="$alert_title"
    :alert_description="$alert_description" :submit_label="$submit_label">
    <x-ui.field.field-group class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <x-ui.field.field-group>
            <x-ui.field>
                <x-ui.field.field-label for="name">Variation Name</x-ui.field.field-label>
                <x-ui.input id="name" name="name" type="text" :value="old('name', $variation?->name)"
                    placeholder="Eg. Black / Large" />
                <x-ui.field.field-error :messages="$errors->get('name')" />
            </x-ui.field>
            <x-ui.field>
                <x-ui.field.field-label for="sku">SKU</x-ui.field.field-label>
                <x-ui.input id="sku" name="sku" type="text" :value="old('sku', $variation?->sku)" placeholder="Eg. TV-43-BLK" />
                <x-ui.field.field-error :messages="$errors->get('sku')" />
            </x-ui.field>
            <x-ui.field>
                <x-ui.field.field-label for="price">Price</x-ui.field.field-label>
                <x-ui.input id="price" name="price" type="number" step="0.01" min="0"
                    :value="old('price', $variation?->price)" />
                <x-ui.field.field-error :messages="$errors->get('price')" />
            </x-ui.field>
            <x-ui.field orientation="horizontal" class="flex items-center gap-3">
                <x-ui.checkbox id="is_default" name="is_default" value="1" :checked="old('is_default', $variation?->is_default ?? false)" />
                <x-ui.field.field-label for="is_default">Set as default variation</x-ui.field.field-label>
            </x-ui.field>
        </x-ui.field.field-group>

        <x-ui.field.field-set>
            <x-ui.field.field-legend>Dimensions</x-ui.field.field-legend>
            <x-ui.field.field-description>Optional shipping and packaging details.</x-ui.field.field-description>
            <x-ui.field.field-group class="grid grid-cols-2 gap-4">
                <x-ui.field>
                    <x-ui.field.field-label for="weight">Weight</x-ui.field.field-label>
                    <x-ui.input id="weight" name="weight" type="number" step="0.01" min="0"
                        :value="old('weight', $variation?->weight)" />
                    <x-ui.field.field-error :messages="$errors->get('weight')" />
                </x-ui.field>
                <x-ui.field>
                    <x-ui.field.field-label for="width">Width</x-ui.field.field-label>
                    <x-ui.input id="width" name="width" type="number" step="0.01" min="0"
                        :value="old('width', $variation?->width)" />
                    <x-ui.field.field-error :messages="$errors->get('width')" />
                </x-ui.field>
                <x-ui.field>
                    <x-ui.field.field-label for="height">Height</x-ui.field.field-label>
                    <x-ui.input id="height" name="height" type="number" step="0.01" min="0"
                        :value="old('height', $variation?->height)" />
                    <x-ui.field.field-error :messages="$errors->get('height')" />
                </x-ui.field>
                <x-ui.field>
                    <x-ui.field.field-label for="depth">Depth</x-ui.field.field-label>
                    <x-ui.input id="depth" name="depth" type="number" step="0.01" min="0"
                        :value="old('depth', $variation?->depth)" />
                    <x-ui.field.field-error :messages="$errors->get('depth')" />
                </x-ui.field>
            </x-ui.field.field-group>
        </x-ui.field.field-set>
    </x-ui.field.field-group>

    <x-ui.field.field-set class="mt-6">
        <x-ui.field.field-legend>Attribute Values</x-ui.field.field-legend>
        <x-ui.field.field-description>Select the values that make up this variation.</x-ui.field.field-description>

        @if ($product->attributes->isEmpty())
            <p class="text-sm text-muted-foreground">No attributes have been configured for this product yet. You can
                still create a default variation.</p>
        @else
            <div class="mt-4 grid gap-4 md:grid-cols-2">
                @foreach ($product->attributes as $attribute)
                    <x-ui.card>
                        <x-ui.card.card-header>
                            <x-ui.card.card-title>{{ $attribute->name }}</x-ui.card.card-title>
                        </x-ui.card.card-header>
                        <x-ui.card.card-content>
                            <x-ui.field.field-group>
                                @foreach ($attribute->values as $value)
                                    <x-ui.field orientation="horizontal" class="flex items-center gap-3">
                                        <x-ui.checkbox id="attribute_value_{{ $value->id }}"
                                            name="attribute_value_ids[]" value="{{ $value->id }}"
                                            :checked="in_array($value->id, $selectedAttributeValueIds, true)" />
                                        <x-ui.field.field-label for="attribute_value_{{ $value->id }}">
                                            {{ $value->value }}
                                        </x-ui.field.field-label>
                                    </x-ui.field>
                                @endforeach
                            </x-ui.field.field-group>
                        </x-ui.card.card-content>
                    </x-ui.card>
                @endforeach
            </div>
            <x-ui.field.field-error :messages="$errors->get('attribute_value_ids')" />
        @endif
    </x-ui.field.field-set>
</x-common.form-card>
