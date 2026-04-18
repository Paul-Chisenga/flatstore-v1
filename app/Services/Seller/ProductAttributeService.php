<?php

namespace App\Services\Seller;

use App\Dtos\Seller\ProductAttribute\CreateProductAttributeDTO;
use App\Dtos\Seller\ProductAttribute\UpdateProductAttributeDTO;
use App\Models\ProductAttribute;
use DB;

use function in_array;

class ProductAttributeService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private ProductAttribute $productAttribute)
    {
        //
    }

    public function create(CreateProductAttributeDTO $data)
    {
        DB::transaction(function () use ($data) {
            $attribute = $this->productAttribute->create([
                'name' => $data->name,
                'product_id' => $data->product_id,
            ]);

            $attribute->values()->createMany(
                array_map(fn ($value) => ['value' => $value], $data->values)
            );
        });
    }

    public function update(ProductAttribute $attribute, UpdateProductAttributeDTO $data)
    {
        DB::transaction(function () use ($attribute, $data) {
            $attribute->update([
                'name' => $data->name,
            ]);

            // Sync values
            $existingValues = $attribute->values()->pluck('value', 'id')->toArray();

            // Delete removed values
            foreach ($existingValues as $id => $value) {
                if (! in_array($value, $data->values)) {
                    $attribute->values()->where('id', $id)->delete();
                }
            }

            // Add new values
            foreach ($data->values as $value) {
                if (! in_array($value, $existingValues)) {
                    $attribute->values()->create(['value' => $value]);
                }
            }
        });
    }

    public function delete(ProductAttribute $attribute)
    {
        $attribute->delete(); // This will also delete associated values due to cascade delete
    }
}
