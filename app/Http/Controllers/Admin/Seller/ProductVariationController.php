<?php

namespace App\Http\Controllers\Admin\Seller;

use App\Dtos\Seller\ProductVariation\CreateProductVariationDTO;
use App\Dtos\Seller\ProductVariation\UpdateProductVariationDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\ProductVariationRequest;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Seller;
use App\Services\Seller\ProductVariationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductVariationController extends Controller
{
    public function __construct(private ProductVariationService $productVariationService) {}

    public function index(Seller $seller, Product $product): RedirectResponse
    {
        return redirect()->route('admin.seller.products.show', ['seller' => $seller, 'product' => $product]);
    }

    public function create(Seller $seller, Product $product): View
    {
        $product->loadMissing('attributes.values');

        return view('app.admin.sellers.products.variations.create', compact('seller', 'product'));
    }

    public function store(ProductVariationRequest $request, Seller $seller, Product $product): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $validated['product_id'] = $product->id;

            $this->productVariationService->create(CreateProductVariationDTO::fromArray($validated));

            return redirect()->route('admin.seller.products.show', ['seller' => $seller, 'product' => $product])
                ->with('success', 'Product variation created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create product variation: '.$e->getMessage()]);
        }
    }

    public function show(Seller $seller, Product $product, ProductVariation $variation): View
    {
        $variation->loadMissing(['attributeValues.attribute', 'stocks.store']);

        return view('app.admin.sellers.products.variations.show', compact('seller', 'product', 'variation'));
    }

    public function edit(Seller $seller, Product $product, ProductVariation $variation): View
    {
        $product->loadMissing('attributes.values');
        $variation->loadMissing('attributeValues.attribute');

        return view('app.admin.sellers.products.variations.edit', compact('seller', 'product', 'variation'));
    }

    public function update(ProductVariationRequest $request, Seller $seller, Product $product, ProductVariation $variation): RedirectResponse
    {
        try {
            $this->productVariationService->update($variation, UpdateProductVariationDTO::fromArray($request->validated()));

            return redirect()->route('admin.seller.products.show', ['seller' => $seller, 'product' => $product])
                ->with('success', 'Product variation updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update product variation: '.$e->getMessage()]);
        }
    }

    public function destroy(Seller $seller, Product $product, ProductVariation $variation): RedirectResponse
    {
        try {
            $this->productVariationService->delete($variation);

            return redirect()->route('admin.seller.products.show', ['seller' => $seller, 'product' => $product])
                ->with('success', 'Product variation deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete product variation: '.$e->getMessage()]);
        }
    }
}
