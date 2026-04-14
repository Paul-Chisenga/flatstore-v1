<?php

namespace App\Services\Admin;

use App\Dtos\Admin\Brand\CreateBrandDTO;
use App\Models\Brand;
use App\Services\S3Service;
use Illuminate\Pagination\LengthAwarePaginator;

class BrandService
{
    public function __construct(private Brand $brand, private S3Service $s3FileUploadService) {}

    public function getAll(): LengthAwarePaginator
    {
        return $this->brand->paginate(10);
    }

    public function create(CreateBrandDTO $data): Brand
    {
        $logo_path = null;

        if ($data->logo !== null) {
            $logo_path = $this->s3FileUploadService->uploadFile($data->logo, 'brands/logos');
        }

        return $this->brand->create([
            'name' => $data->name,
            'description' => $data->description,
            'logo_path' => $logo_path,
        ]);
    }

    public function update(Brand $brand, CreateBrandDTO $data): Brand
    {
        $old_logo_path = $brand->logo_path;
        $logo_path = $old_logo_path;

        if ($data->logo !== null) {
            $logo_path = $this->s3FileUploadService->uploadFile($data->logo, 'brands/logos');

            // Delete old logo if it exists
            if ($old_logo_path) {
                // Attempt to delete the old logo, but don't fail the update if it fails
                try {
                    $this->s3FileUploadService->deleteFile($old_logo_path);
                } catch (\Exception $e) {
                    // Log the error but don't fail the update
                    \Log::error('Failed to delete old logo from S3: '.$e->getMessage());
                }
            }
        }

        $brand->update([
            'name' => $data->name,
            'description' => $data->description,
            'logo_path' => $logo_path,
        ]);

        return $brand;
    }

    public function delete(Brand $brand): void
    {
        $old_logo_path = $brand->logo_path;

        if ($old_logo_path) {
            // Attempt to delete the logo, but don't fail the deletion if it fails
            try {
                $this->s3FileUploadService->deleteFile($old_logo_path);
            } catch (\Exception $e) {
                // Log the error but don't fail the deletion
                \Log::error('Failed to delete logo from S3: '.$e->getMessage());
            }
        }

        $brand->delete();
    }
}
