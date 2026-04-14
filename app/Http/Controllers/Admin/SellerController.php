<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.admin.sellers.index', [
            'sellers' => [
                (object) [
                    'id' => 1,
                    'name' => 'Seller 1',
                    'stores' => ['Store A', 'Store B'],
                    'created_at' => Carbon::parse('2024-01-01'),
                    'products_count' => 10,
                ],
                (object) [
                    'id' => 2,
                    'name' => 'Seller 2',
                    'stores' => ['Store C'],
                    'created_at' => Carbon::parse('2024-02-01'),
                    'products_count' => 5,
                ],
                (object) [
                    'id' => 3,
                    'name' => 'Seller 3',
                    'stores' => ['Store D'],
                    'created_at' => Carbon::parse('2024-03-01'),
                    'products_count' => 8,
                ],
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.admin.sellers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
