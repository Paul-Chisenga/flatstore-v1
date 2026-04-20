@props(['action', 'product', 'media' => null, 'title', 'description', 'alert_title' => null])

@php
    /** @var \App\Models\Product $product */
    /** @var \App\Models\ProductMedia|null $media */

    $selectedType = old('type', $media?->type ?? \App\Enums\ProductMediaType::IMAGE->value);
    $selectedVariationId = old('product_variation_id', $media?->product_variation_id);
    $isPrimary = (bool) old('is_primary', $media?->is_primary ?? false);
@endphp

<x-common.form-card :action="$action" :title="$title" :description="$description" :alert_title="$alert_title" :isEdit="$media !== null"
    :submit_label="$media ? 'Save Media' : 'Upload Media'" enctype="multipart/form-data">
    <div class="space-y-6">
        @if ($media && $media->type !== \App\Enums\ProductMediaType::VIDEO->value)
            <div class="space-y-2">
                <p class="text-sm font-medium">Current File</p>
                <img src="{{ route('download', ['file_path' => $media->file_path]) }}" alt="{{ $product->name }} media"
                    class="h-48 w-full rounded-xl border object-cover sm:max-w-md" />
            </div>
        @endif

        <x-ui.field.field-group class="grid gap-6 md:grid-cols-2">
            <x-ui.field>
                <x-ui.field.field-label for="file">Media File</x-ui.field.field-label>
                <x-ui.input id="file" name="file" type="file" accept="image/*,video/*" />
                <x-ui.field.field-description>
                    Upload an image or video for this product.
                </x-ui.field.field-description>
                <x-ui.field.field-error :messages="$errors->get('file')" />
            </x-ui.field>

            <x-ui.field>
                <x-ui.field.field-label for="type">Media Type</x-ui.field.field-label>
                <x-ui.select id="type" name="type">
                    @foreach (\App\Enums\ProductMediaType::cases() as $type)
                        <option value="{{ $type->value }}" @selected($selectedType === $type->value)>
                            {{ ucfirst($type->value) }}
                        </option>
                    @endforeach
                </x-ui.select>
                <x-ui.field.field-error :messages="$errors->get('type')" />
            </x-ui.field>

            <x-ui.field>
                <x-ui.field.field-label for="product_variation_id">Variation</x-ui.field.field-label>
                <x-ui.select id="product_variation_id" name="product_variation_id">
                    <option value="">Whole product</option>
                    @foreach ($product->variations as $variation)
                        @php
                            $variationName =
                                $variation->name ?:
                                ($variation->attributeValues->pluck('value')->implode(' / ') ?:
                                $variation->sku);
                        @endphp
                        <option value="{{ $variation->id }}" @selected((string) $selectedVariationId === (string) $variation->id)>
                            {{ $variationName }}
                        </option>
                    @endforeach
                </x-ui.select>
                <x-ui.field.field-description>
                    Optionally target a single product variation.
                </x-ui.field.field-description>
                <x-ui.field.field-error :messages="$errors->get('product_variation_id')" />
            </x-ui.field>

            <x-ui.field>
                <x-ui.field.field-label for="is_primary">Primary Media</x-ui.field.field-label>
                <label class="flex h-10 items-center gap-2 rounded-xl border px-3 text-sm">
                    <input type="hidden" name="is_primary" value="0">
                    <x-ui.checkbox id="is_primary" name="is_primary" value="1" :checked="$isPrimary" />
                    <span>Use this as the main product media</span>
                </label>
                <x-ui.field.field-error :messages="$errors->get('is_primary')" />
            </x-ui.field>
        </x-ui.field.field-group>
    </div>
</x-common.form-card>
