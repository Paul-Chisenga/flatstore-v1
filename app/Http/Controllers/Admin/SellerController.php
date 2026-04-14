<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\Admin\Seller\CreateSellerDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SellerRequest;
use App\Services\Admin\SellerService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SellerController extends Controller
{
    public function __construct(private SellerService $sellerService) {}

    public function index()
    {
        $sellers = $this->sellerService->getAll();

        return view('app.admin.sellers.index', compact('sellers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('app.admin.sellers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SellerRequest $request)
    {
        try {
            $seller = $this->sellerService->create(CreateSellerDTO::fromArray($request->validated()));

            return redirect()->route('admin.sellers')->with('success', 'Seller created successfully.');
        } catch (\Exception  $e) {
            return back()->withErrors(['error' => 'Failed to create seller: '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
