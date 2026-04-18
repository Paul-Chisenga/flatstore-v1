<?php

namespace App\Http\Controllers\Admin\Seller;

use App\Dtos\Seller\Store\CreateStoreDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\StoreRequest;
use App\Models\Seller;
use App\Models\Store;
use App\Services\Seller\StoreService;

class StoreController extends Controller
{
    public function __construct(private StoreService $storeService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Seller $seller)
    {
        $stores = $this->storeService->getAll($seller->id);

        return view('app.admin.sellers.stores.index', compact('seller', 'stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Seller $seller)
    {
        $sellers = Seller::whereKey($seller->id)->get();
        $seller_id = $seller->id;

        return view('app.admin.sellers.stores.create', compact('sellers', 'seller_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Seller $seller, StoreRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['seller_id'] = $seller->id;
            $this->storeService->create(CreateStoreDTO::fromArray($validated));

            return redirect()->route('admin.seller.stores', ['seller' => $seller->id])->with('success', 'Store created successfully.');
        } catch (\Exception  $e) {
            return back()->withErrors(['error' => 'Failed to create store: '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Seller $seller, Store $store)
    {
        $store = $this->storeService->findById($store->id);

        return view('app.admin.sellers.stores.show', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seller $seller, Store $store)
    {
        $sellers = Seller::whereHas('stores', fn ($query) => $query->where('id', $store->id))->get();

        return view('app.admin.sellers.stores.edit', compact('store', 'sellers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Seller $seller, Store $store)
    {
        try {
            $validated = $request->validated();
            $validated['seller_id'] = $seller->id;
            $this->storeService->update($store, CreateStoreDTO::fromArray($validated));

            return redirect()->route('admin.seller.stores', ['seller' => $store->seller_id])->with('success', 'Store updated successfully.');
        } catch (\Exception  $e) {
            return back()->withErrors(['error' => 'Failed to update store: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seller $seller, Store $store)
    {
        try {
            $this->storeService->delete($store);

            return redirect()->route('admin.seller.stores', ['seller' => $store->seller_id])->with('success', 'Store deleted successfully.');
        } catch (\Exception  $e) {
            return back()->withErrors(['error' => 'Failed to delete store: '.$e->getMessage()]);
        }
    }
}
