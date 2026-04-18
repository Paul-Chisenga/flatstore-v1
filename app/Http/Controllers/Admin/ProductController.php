<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\Admin\Product\CreateProductDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use App\Services\Admin\ProductService;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = $this->productService->getAll();

        return view('app.admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $sellers = Seller::all();
        $brands = Brand::all();
        $categories = Category::all();
        $seller_id = request()->query('seller_id');

        return view('app.admin.products.create', compact('sellers', 'brands', 'categories', 'seller_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try {
            $product = $this->productService->create(CreateProductDTO::fromArray($request->validated()));

            return redirect()->route('admin.seller.products.show', ['seller' => $product->seller_id, 'product' => $product->id])->with('success', 'Product created successfully. You can now add attributes to the product and other details.');
        } catch (\Exception  $e) {
            return back()->withErrors(['error' => 'Failed to create product: '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->productService->findById((int) $id);

        if (! $product) {
            return redirect()->route('admin.products')->withErrors(['error' => 'Product not found.']);
        }

        return view('app.admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = $this->productService->findById((int) $id);

        if (! $product) {
            return redirect()->route('admin.products')->withErrors(['error' => 'Product not found.']);
        }

        $sellers = Seller::all();
        $brands = Brand::all();
        $categories = Category::all();
        $seller_id = $product->seller_id;

        return view('app.admin.products.edit', compact('product', 'sellers', 'brands', 'categories', 'seller_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        try {
            $product = $this->productService->update($product, CreateProductDTO::fromArray($request->validated()));

            return redirect()->route('admin.seller.products.show', ['seller' => $product->seller_id, 'product' => $product->id])->with('success', 'Product updated successfully.');
        } catch (\Exception  $e) {
            return back()->withErrors(['error' => 'Failed to update product: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $sellerId = $product->seller_id;

            $this->productService->delete($product);

            return redirect()->route('admin.seller.products', ['seller' => $sellerId])->with('success', 'Product deleted successfully.');
        } catch (\Exception  $e) {
            return back()->withErrors(['error' => 'Failed to delete product: '.$e->getMessage()]);
        }
    }
}
