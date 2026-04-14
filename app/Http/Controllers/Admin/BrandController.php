<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\Admin\Brand\CreateBrandDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Models\Brand;
use App\Services\Admin\BrandService;
use Exception;
use Illuminate\View\View;

class BrandController extends Controller
{
    public function __construct(private BrandService $brandService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $brands = $this->brandService->getAll();

        return view('app.admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        try {
            $brand = $this->brandService->create(CreateBrandDTO::fromArray($request->validated()));

            return redirect()->route('admin.brands')->with('success', 'Brand created successfully.');
        } catch (Exception  $e) {
            return back()->withErrors(['error' => 'Failed to create brand: '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('app.admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        try {
            $this->brandService->update($brand, CreateBrandDTO::fromArray($request->validated()));

            return redirect()->route('admin.brands')->with('success', 'Brand updated successfully.');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Failed to update brand: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $this->brandService->delete($brand);

        return redirect()->route('admin.brands')->with('success', 'Brand deleted successfully.');
    }
}
