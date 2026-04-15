<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\Seller\Store\CreateStoreDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\StoreRequest;
use App\Models\Seller;
use App\Models\Store;
use App\Services\Admin\StoreService;

class StoreController extends Controller
{
    public function __construct(private StoreService $storeService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = $this->storeService->getAll();

        return view('app.admin.stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sellers = Seller::all();

        // attempt to get seller_id from query params
        $seller_id = request()->query('seller_id');

        return view('app.admin.stores.create', compact('sellers', 'seller_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $this->storeService->create(CreateStoreDTO::fromArray($request->validated()));

            return redirect()->route('admin.stores')->with('success', 'Store created successfully.');
        } catch (\Exception  $e) {
            return back()->withErrors(['error' => 'Failed to create store: '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        $store = $this->storeService->findById($store->id);

        return view('app.admin.stores.show', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        $sellers = Seller::whereHas('stores', fn ($query) => $query->where('id', $store->id))->get();

        return view('app.admin.stores.edit', compact('store', 'sellers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Store $store)
    {
        try {
            $this->storeService->update($store, CreateStoreDTO::fromArray($request->validated()));

            return redirect()->route('admin.stores')->with('success', 'Store updated successfully.');
        } catch (\Exception  $e) {
            return back()->withErrors(['error' => 'Failed to update store: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        try {
            $this->storeService->delete($store);

            return redirect()->route('admin.stores')->with('success', 'Store deleted successfully.');
        } catch (\Exception  $e) {
            return back()->withErrors(['error' => 'Failed to delete store: '.$e->getMessage()]);
        }
    }
}
