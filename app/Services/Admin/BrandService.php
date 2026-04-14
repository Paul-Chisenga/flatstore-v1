<?php

namespace App\Services\Admin;

use App\Dtos\Admin\Brand\CreateBrandDTO;
use App\Models\Brand;
use Illuminate\Pagination\LengthAwarePaginator;

class BrandService
{
    public function __construct(private Brand $brand) {}

    public function getAll(): LengthAwarePaginator
    {
        return $this->brand->with('logo')->paginate(10);
    }

    public function create(CreateBrandDTO $data): Brand
    {
        $brand = $this->brand->create([
            'name' => $data->name,
            'description' => $data->description,
        ]);

        return $brand;
    }

    public function update(Brand $brand, CreateBrandDTO $data): Brand
    {
        $brand->update([
            'name' => $data->name,
            'description' => $data->description,
        ]);

        return $brand;
    }

    public function delete(Brand $brand): void
    {
        $brand->delete();
    }
}
