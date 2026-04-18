<?php

namespace App\Services\Seller;

use App\Dtos\Admin\Product\CreateProductDTO;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private Product $product)
    {
        //
    }

    public function getAll(int $sellerId)
    {
        return $this->product
            ->with(['brand', 'seller', 'categories'])
            ->where('seller_id', $sellerId)
            ->withCount('variations')
            ->latest()
            ->paginate(12);
    }

    public function create(CreateProductDTO $data)
    {
        return DB::transaction(function () use ($data) {
            $product = $this->product->create([
                'name' => $data->name,
                'description' => $data->description,
                'brand_id' => $data->brand_id,
                'seller_id' => $data->seller_id,
            ]);

            $product->categories()->sync($data->category_ids ?? []);

            return $product->load(['brand', 'seller', 'categories']);
        });
    }

    public function findById(int $id): ?Product
    {
        return $this->product
            ->with([
                'brand',
                'seller',
                'categories',
                'attributes.values',
                'variations.attributeValues.attribute',
            ])
            ->withCount('variations')
            ->find($id);
    }

    public function update(Product $product, CreateProductDTO $data)
    {
        return DB::transaction(function () use ($product, $data) {
            $product->update([
                'name' => $data->name,
                'description' => $data->description,
                'brand_id' => $data->brand_id,
                'seller_id' => $data->seller_id,
            ]);

            $product->categories()->sync($data->category_ids ?? []);

            return $product->load(['brand', 'seller', 'categories']);
        });
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }
}
