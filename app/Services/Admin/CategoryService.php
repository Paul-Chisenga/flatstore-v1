<?php

namespace App\Services\Admin;

use App\Dtos\Admin\Category\CreateCategoryDTO;
use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryService
{
    public function __construct(private Category $category) {}

    public function getAll(): LengthAwarePaginator
    {
        return $this->category
            ->whereNull('parent_id')
            ->with('children')
            ->with('products')
            ->paginate(10);
    }

    public function create(CreateCategoryDTO $data): Category
    {
        return $this->category->create([
            'name' => $data->name,
            'description' => $data->description,
            'metadata' => $data->ionicon_name ? ['ionicon_name' => $data->ionicon_name] : null,
        ]);
    }

    public function update(Category $category, CreateCategoryDTO $data): Category
    {
        $currentMetadata = $category->metadata ?? [];
        $newMetadata = $data->ionicon_name ? [...$currentMetadata, 'ionicon_name' => $data->ionicon_name] : $currentMetadata;
        $category->update([
            'name' => $data->name,
            'description' => $data->description,
            'metadata' => $newMetadata,
        ]);

        return $category;
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }

    public function addChild(Category $parent, CreateCategoryDTO $data): Category
    {
        return $parent->children()->create([
            'name' => $data->name,
            'description' => $data->description,
            'metadata' => $data->ionicon_name ? ['ionicon_name' => $data->ionicon_name] : null,
        ]);
    }
}
