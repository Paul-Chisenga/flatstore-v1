<?php

namespace App\Http\Controllers\Admin\Seller;

use App\Dtos\Seller\ProductMedia\UpsertProductMediaDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\ProductMediaRequest;
use App\Models\Product;
use App\Models\ProductMedia;
use App\Models\Seller;
use App\Services\Seller\ProductMediaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductMediaController extends Controller
{
    public function __construct(private ProductMediaService $productMediaService) {}

    public function create(Seller $seller, Product $product): View
    {
        abort_unless($product->seller_id === $seller->id, 404);

        $product->loadMissing('variations.attributeValues');

        return view('app.admin.sellers.products.medias.create', compact('seller', 'product'));
    }

    public function store(ProductMediaRequest $request, Seller $seller, Product $product): RedirectResponse
    {
        abort_unless($product->seller_id === $seller->id, 404);

        try {
            $this->productMediaService->create($product, UpsertProductMediaDTO::fromArray($request->validated()));

            return redirect()
                ->route('admin.seller.products.show', ['seller' => $seller, 'product' => $product])
                ->with('success', 'Product media created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create product media: '.$e->getMessage()]);
        }
    }

    public function edit(Seller $seller, Product $product, ProductMedia $media): View
    {
        abort_unless($product->seller_id === $seller->id && $media->product_id === $product->id, 404);

        $product->loadMissing('variations.attributeValues');

        return view('app.admin.sellers.products.medias.edit', compact('seller', 'product', 'media'));
    }

    public function update(ProductMediaRequest $request, Seller $seller, Product $product, ProductMedia $media): RedirectResponse
    {
        abort_unless($product->seller_id === $seller->id && $media->product_id === $product->id, 404);

        try {
            $this->productMediaService->update($product, $media, UpsertProductMediaDTO::fromArray($request->validated()));

            return redirect()
                ->route('admin.seller.products.show', ['seller' => $seller, 'product' => $product])
                ->with('success', 'Product media updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update product media: '.$e->getMessage()]);
        }
    }

    public function destroy(Seller $seller, Product $product, ProductMedia $media): RedirectResponse
    {
        abort_unless($product->seller_id === $seller->id && $media->product_id === $product->id, 404);

        try {
            $this->productMediaService->delete($media);

            return redirect()
                ->route('admin.seller.products.show', ['seller' => $seller, 'product' => $product])
                ->with('success', 'Product media deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete product media: '.$e->getMessage()]);
        }
    }
}
