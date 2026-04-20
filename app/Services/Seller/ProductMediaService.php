<?php

namespace App\Services\Seller;

use App\Dtos\Seller\ProductMedia\UpsertProductMediaDTO;
use App\Models\Product;
use App\Models\ProductMedia;
use App\Services\S3Service;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class ProductMediaService
{
    public function __construct(private S3Service $s3Service) {}

    public function create(Product $product, UpsertProductMediaDTO $data): ProductMedia
    {
        if (! $data->file) {
            throw new InvalidArgumentException('A media file is required.');
        }

        $filePath = $this->s3Service->uploadFile($data->file, 'products/media');

        try {
            return DB::transaction(function () use ($product, $data, $filePath) {
                if ($data->is_primary) {
                    $product->medias()->update(['is_primary' => false]);
                }

                return $product->medias()->create([
                    'product_variation_id' => $data->product_variation_id,
                    'file_path' => $filePath,
                    'type' => $data->type,
                    'is_primary' => $data->is_primary,
                ]);
            });
        } catch (\Exception $e) {
            $this->s3Service->deleteFile($filePath);

            throw $e;
        }
    }

    public function update(Product $product, ProductMedia $media, UpsertProductMediaDTO $data): ProductMedia
    {
        $oldPath = $media->file_path;
        $newPath = $oldPath;

        if ($data->file) {
            $newPath = $this->s3Service->uploadFile($data->file, 'products/media');
        }

        try {
            $updatedMedia = DB::transaction(function () use ($product, $media, $data, $newPath) {
                if ($data->is_primary) {
                    $product->medias()->whereKeyNot($media->id)->update(['is_primary' => false]);
                }

                $media->update([
                    'product_variation_id' => $data->product_variation_id,
                    'file_path' => $newPath,
                    'type' => $data->type,
                    'is_primary' => $data->is_primary,
                ]);

                return $media->fresh(['productVariation.attributeValues.attribute']);
            });

            if ($data->file && $oldPath && $oldPath !== $newPath) {
                $this->s3Service->deleteFile($oldPath);
            }

            return $updatedMedia;
        } catch (\Exception $e) {
            if ($data->file && $newPath && $newPath !== $oldPath) {
                $this->s3Service->deleteFile($newPath);
            }

            throw $e;
        }
    }

    public function delete(ProductMedia $media): void
    {
        $filePath = $media->file_path;

        DB::transaction(function () use ($media) {
            $media->delete();
        });

        if ($filePath) {
            $this->s3Service->deleteFile($filePath);
        }
    }
}
