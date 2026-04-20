<?php

namespace App\Http\Controllers\Admin\Seller;

use App\Dtos\Admin\Product\CreateProductDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use App\Services\Seller\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Seller $seller): View
    {
        $products = $this->productService->getAll($seller->id);

        return view('app.admin.sellers.products.index', compact('seller', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Seller $seller): View
    {
        $brands = Brand::all();
        $categories = Category::all();

        return view('app.admin.sellers.products.create', compact('brands', 'categories', 'seller'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request, Seller $seller): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $validated['seller_id'] = $seller->id;

            $product = $this->productService->create(CreateProductDTO::fromArray($validated));

            return redirect()
                ->route('admin.seller.products.show', ['seller' => $seller, 'product' => $product])
                ->with('success', 'Product created successfully. You can now add attributes to the product and other details.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create product: '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Seller $seller, Product $product): View
    {
        $product = $this->productService->findById($product->id);

        return view('app.admin.sellers.products.show', compact('seller', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seller $seller, Product $product): View
    {
        $product = $this->productService->findById($product->id);
        $brands = Brand::all();
        $categories = Category::all();

        return view('app.admin.sellers.products.edit', compact('product', 'brands', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Seller $seller, Product $product): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $validated['seller_id'] = $seller->id;

            $product = $this->productService->update($product, CreateProductDTO::fromArray($validated));

            return redirect()
                ->route('admin.seller.products.show', ['seller' => $seller, 'product' => $product])
                ->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update product: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seller $seller, Product $product): RedirectResponse
    {
        try {
            $this->productService->delete($product);

            return redirect()
                ->route('admin.seller.products', ['seller' => $seller])
                ->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete product: '.$e->getMessage()]);
        }
    }
}
