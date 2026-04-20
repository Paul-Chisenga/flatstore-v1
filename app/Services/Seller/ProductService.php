<?php

namespace App\Services\Seller;

use App\Dtos\Admin\Product\CreateProductDTO;
use App\Dtos\Admin\Product\UpdateProductDTO;
use App\Models\Product;
use App\Services\S3Service;
use Illuminate\Support\Facades\DB;

class ProductService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private Product $product, private S3Service $s3Service)
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
        $thumbnail_path = $this->s3Service->uploadFile($data->thumbnail, 'products/thumbnails');
        try {
            return DB::transaction(function () use ($data, $thumbnail_path) {
                $product = $this->product->create([
                    'name' => $data->name,
                    'description' => $data->description,
                    'brand_id' => $data->brand_id,
                    'seller_id' => $data->seller_id,
                    'thumbnail_path' => $thumbnail_path,
                ]);

                $product->categories()->sync($data->category_ids ?? []);

                return $product->load(['brand', 'seller', 'categories']);
            });
        } catch (\Exception $e) {
            if ($thumbnail_path) {
                $this->s3Service->deleteFile($thumbnail_path);
            }
            throw $e;
        }
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
                'medias.productVariation.attributeValues.attribute',
            ])
            ->withCount(['variations', 'medias'])
            ->find($id);
    }

    public function update(Product $product, UpdateProductDTO $data)
    {
        $thumbnail_path = null;
        if ($data->thumbnail) {
            $thumbnail_path = $this->s3Service->uploadFile($data->thumbnail, 'products/thumbnails');
        }
        try {
            return DB::transaction(function () use ($product, $data, $thumbnail_path) {
                $product->update([
                    'name' => $data->name,
                    'description' => $data->description,
                    'brand_id' => $data->brand_id,
                    'seller_id' => $data->seller_id,
                    'thumbnail_path' => $thumbnail_path ?? $product->thumbnail_path,
                ]);

                $product->categories()->sync($data->category_ids ?? []);

                if ($thumbnail_path && $product->thumbnail_path) {
                    try {
                        $this->s3Service->deleteFile($product->thumbnail_path);
                    } catch (\Exception $e) {
                        // Log the error but don't fail the entire transaction
                        \Log::error('Failed to delete old thumbnail: '.$e->getMessage());
                    }
                }

                return $product->load(['brand', 'seller', 'categories']);
            });
        } catch (\Exception $e) {
            if ($thumbnail_path) {
                $this->s3Service->deleteFile($thumbnail_path);
            }
            throw $e;
        }
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }
}
