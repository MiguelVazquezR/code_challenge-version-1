<?php

namespace App\Http\Controllers;

use App\Http\Resources\SupplierProductResource;
use App\Models\SupplierProduct;
use Illuminate\Http\Request;

class SupplierProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $SupplierProducts = SupplierProductResource::collection(SupplierProduct::all());

        return $SupplierProducts;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required',
            'supply_id' => 'required',
        ]);

        $created_SupplierProduct = SupplierProduct::create($validated);

        return $created_SupplierProduct;
    }

    /**
     * Display the specified resource.
     */
    public function show(SupplierProduct $SupplierProduct)
    {
        $SupplierProduct = SupplierProductResource::make($SupplierProduct);

        return $SupplierProduct;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupplierProduct $SupplierProduct)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:45',
        ]);

        $updated_SupplierProduct = $SupplierProduct->update($validated);

        return $updated_SupplierProduct;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplierProduct $SupplierProduct)
    {
        $deleted_SupplierProduct = $SupplierProduct->delete();

        return $deleted_SupplierProduct;
    }
}
