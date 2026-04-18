<?php

namespace App\Services\Seller;

use App\Dtos\Seller\ProductVariation\CreateProductVariationDTO;
use App\Dtos\Seller\ProductVariation\UpdateProductVariationDTO;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\DB;

class ProductVariationService
{
    public function __construct(private ProductVariation $productVariation) {}

    public function create(CreateProductVariationDTO $data): ProductVariation
    {
        return DB::transaction(function () use ($data) {
            $product = Product::query()->findOrFail($data->product_id);
            $shouldBeDefault = $data->is_default || ! $product->variations()->exists();

            if ($shouldBeDefault) {
                $product->variations()->update(['is_default' => false]);
            }

            $variation = $product->variations()->create([
                'sku' => $data->sku,
                'name' => $data->name,
                'price' => $data->price,
                'weight' => $data->weight,
                'width' => $data->width,
                'height' => $data->height,
                'depth' => $data->depth,
                'is_default' => $shouldBeDefault,
            ]);

            $variation->attributeValues()->sync($data->attribute_value_ids);

            return $variation->load('attributeValues.attribute');
        });
    }

    public function update(ProductVariation $variation, UpdateProductVariationDTO $data): ProductVariation
    {
        return DB::transaction(function () use ($variation, $data) {
            $product = $variation->product;
            $hasAnotherDefault = $product->variations()
                ->whereKeyNot($variation->id)
                ->where('is_default', true)
                ->exists();

            $shouldBeDefault = $data->is_default || ! $hasAnotherDefault;

            if ($shouldBeDefault) {
                $product->variations()->whereKeyNot($variation->id)->update(['is_default' => false]);
            }

            $variation->update([
                'sku' => $data->sku,
                'name' => $data->name,
                'price' => $data->price,
                'weight' => $data->weight,
                'width' => $data->width,
                'height' => $data->height,
                'depth' => $data->depth,
                'is_default' => $shouldBeDefault,
            ]);

            $variation->attributeValues()->sync($data->attribute_value_ids);

            return $variation->load('attributeValues.attribute');
        });
    }

    public function delete(ProductVariation $variation): void
    {
        DB::transaction(function () use ($variation) {
            $product = $variation->product;
            $wasDefault = $variation->is_default;

            $variation->delete();

            if ($wasDefault && ! $product->variations()->where('is_default', true)->exists()) {
                $fallbackVariation = $product->variations()->orderBy('id')->first();

                if ($fallbackVariation instanceof ProductVariation) {
                    $fallbackVariation->update(['is_default' => true]);
                }
            }
        });
    }
}
