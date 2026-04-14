<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\Admin\Category\CreateCategoryDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Services\Admin\CategoryService;
use Exception;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService) {}

    public function index(): View
    {
        $categories = $this->categoryService->getAll();

        return view('app.admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('app.admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        try {
            $this->categoryService->create(CreateCategoryDTO::fromArray($request->validated()));

            return redirect()->route('admin.categories')->with('success', 'Category created successfully.');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Failed to create category: '.$e->getMessage()]);
        }
    }

    public function edit(Category $category): View
    {
        $parentCategories = Category::query()->whereNull('parent_id')->where('id', '!=', $category->id)->get();

        return view('app.admin.categories.edit', compact('category', 'parentCategories'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $this->categoryService->update($category, CreateCategoryDTO::fromArray($request->validated()));

            return redirect()->route('admin.categories')->with('success', 'Category updated successfully.');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Failed to update category: '.$e->getMessage()]);
        }
    }

    public function destroy(Category $category)
    {
        $this->categoryService->delete($category);

        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully.');
    }

    public function createChild(Category $parentCategory): View
    {
        return view('app.admin.categories.create-child', compact('parentCategory'));
    }

    public function storeChild(CategoryRequest $request, Category $parentCategory)
    {
        try {
            $this->categoryService->addChild($parentCategory, CreateCategoryDTO::fromArray($request->validated()));

            return redirect()->route('admin.categories')->with('success', 'Child category created successfully.');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Failed to create child category: '.$e->getMessage()]);
        }
    }
}
