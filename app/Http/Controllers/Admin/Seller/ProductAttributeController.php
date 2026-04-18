<?php

namespace App\Http\Controllers\Admin\Seller;

use App\Dtos\Seller\ProductAttribute\CreateProductAttributeDTO;
use App\Dtos\Seller\ProductAttribute\UpdateProductAttributeDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\ProductAttributeRequest;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Seller;
use App\Services\Seller\ProductAttributeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductAttributeController extends Controller
{
    public function __construct(private ProductAttributeService $productAttributeService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Seller $seller, Product $product): View
    {
        return view('app.admin.sellers.products.attributes.create', compact('seller', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductAttributeRequest $request, Seller $seller, Product $product): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $validated['product_id'] = $product->id;

            $this->productAttributeService->create(CreateProductAttributeDTO::fromArray($validated));

            return redirect()->route('admin.seller.products.show', ['seller' => $seller, 'product' => $product])->with('success', 'Product attribute created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create product attribute: '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Seller $seller, Product $product, ProductAttribute $attribute): View
    {
        $attribute->loadMissing(['values.variations']);

        return view('app.admin.sellers.products.attributes.show', compact('seller', 'product', 'attribute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seller $seller, Product $product, ProductAttribute $attribute): View
    {
        return view('app.admin.sellers.products.attributes.edit', compact('seller', 'product', 'attribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductAttributeRequest $request, Seller $seller, Product $product, ProductAttribute $attribute): RedirectResponse
    {
        try {
            $validated = $request->validated();

            $this->productAttributeService->update($attribute, UpdateProductAttributeDTO::fromArray($validated));

            return redirect()->route('admin.seller.products.show', ['seller' => $seller, 'product' => $product])->with('success', 'Product attribute updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update product attribute: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seller $seller, Product $product, ProductAttribute $attribute): RedirectResponse
    {
        try {
            $this->productAttributeService->delete($attribute);

            return redirect()->route('admin.seller.products.show', ['seller' => $seller, 'product' => $product])->with('success', 'Product attribute deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete product attribute: '.$e->getMessage()]);
        }
    }
}
