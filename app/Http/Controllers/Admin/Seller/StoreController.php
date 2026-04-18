<?php

namespace App\Http\Controllers\Admin\Seller;

use App\Dtos\Seller\ProductVariation\UpdateVariationStockDTO;
use App\Dtos\Seller\Store\CreateStoreDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\StoreRequest;
use App\Http\Requests\Seller\UpdateVariationStockRequest;
use App\Models\Seller;
use App\Models\Store;
use App\Models\StoreVariationStock;
use App\Services\Seller\ProductVariationService;
use App\Services\Seller\StoreService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function __construct(
        private StoreService $storeService,
        private ProductVariationService $productVariationService,
    ) {}

    public function index(Seller $seller): View
    {
        $stores = $this->storeService->getAll($seller->id);

        return view('app.admin.sellers.stores.index', compact('seller', 'stores'));
    }

    public function create(Seller $seller): View
    {
        $sellers = Seller::whereKey($seller->id)->get();
        $seller_id = $seller->id;

        return view('app.admin.sellers.stores.create', compact('sellers', 'seller_id'));
    }

    public function store(Seller $seller, StoreRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $validated['seller_id'] = $seller->id;
            $this->storeService->create(CreateStoreDTO::fromArray($validated));

            return redirect()->route('admin.seller.stores', ['seller' => $seller->id])->with('success', 'Store created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create store: '.$e->getMessage()]);
        }
    }

    public function show(Seller $seller, Store $store): View
    {
        abort_unless($store->seller_id === $seller->id, 404);

        $store = $this->storeService->findById($store->id);

        return view('app.admin.sellers.stores.show', compact('store'));
    }

    public function edit(Seller $seller, Store $store): View
    {
        abort_unless($store->seller_id === $seller->id, 404);

        $sellers = Seller::whereHas('stores', fn ($query) => $query->where('id', $store->id))->get();

        return view('app.admin.sellers.stores.edit', compact('store', 'sellers'));
    }

    public function update(StoreRequest $request, Seller $seller, Store $store): RedirectResponse
    {
        abort_unless($store->seller_id === $seller->id, 404);

        try {
            $validated = $request->validated();
            $validated['seller_id'] = $seller->id;
            $this->storeService->update($store, CreateStoreDTO::fromArray($validated));

            return redirect()->route('admin.seller.stores', ['seller' => $store->seller_id])->with('success', 'Store updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update store: '.$e->getMessage()]);
        }
    }

    public function destroy(Seller $seller, Store $store): RedirectResponse
    {
        abort_unless($store->seller_id === $seller->id, 404);

        try {
            $this->storeService->delete($store);

            return redirect()->route('admin.seller.stores', ['seller' => $store->seller_id])->with('success', 'Store deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete store: '.$e->getMessage()]);
        }
    }

    public function updateStock(
        UpdateVariationStockRequest $request,
        Seller $seller,
        Store $store,
        StoreVariationStock $variationStock,
    ): RedirectResponse {
        abort_unless($store->seller_id === $seller->id && $variationStock->store_id === $store->id, 404);

        try {
            $this->productVariationService->updateStock(
                $variationStock,
                UpdateVariationStockDTO::fromArray($request->validated()),
            );

            return redirect()
                ->route('admin.seller.stores.show', ['seller' => $seller, 'store' => $store])
                ->with('success', 'Store stock updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update store stock: '.$e->getMessage()]);
        }
    }

    public function destroyStock(Seller $seller, Store $store, StoreVariationStock $variationStock): RedirectResponse
    {
        abort_unless($store->seller_id === $seller->id && $variationStock->store_id === $store->id, 404);

        try {
            $this->productVariationService->deleteStock($variationStock);

            return redirect()
                ->route('admin.seller.stores.show', ['seller' => $seller, 'store' => $store])
                ->with('success', 'Store stock removed successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to remove store stock: '.$e->getMessage()]);
        }
    }
}
