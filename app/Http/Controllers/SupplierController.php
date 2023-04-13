<?php

namespace App\Http\Controllers;

use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Suppliers = SupplierResource::collection(Supplier::all());

        return $Suppliers;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:45',
        ]);

        $created_Supplier = Supplier::create($validated);

        return $created_Supplier;
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $Supplier)
    {
        $Supplier = SupplierResource::make($Supplier);

        return $Supplier;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $Supplier)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:45',
        ]);

        $updated_Supplier = $Supplier->update($validated);

        return $updated_Supplier;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $Supplier)
    {
        $deleted_Supplier = $Supplier->delete();

        return $deleted_Supplier;
    }
}
