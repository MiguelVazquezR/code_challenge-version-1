<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderDetailResource;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $OrderDetails = OrderDetailResource::collection(OrderDetail::all());

        return $OrderDetails;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'price' => 'required|numeric|min:1',
            'order_id' => 'required',
            'product_id' => 'required',
        ]);

        $created_OrderDetail = OrderDetail::create($validated);

        return $created_OrderDetail;
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderDetail $OrderDetail)
    {
        $OrderDetail = OrderDetailResource::make($OrderDetail);

        return $OrderDetail;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderDetail $OrderDetail)
    {
        $validated = $request->validate([
            'price' => 'required|numeric|min:1',
            'order_id' => 'required',
            'product_id' => 'required',
        ]);

        $updated_OrderDetail = $OrderDetail->update($validated);

        return $updated_OrderDetail;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderDetail $OrderDetail)
    {
        $deleted_OrderDetail = $OrderDetail->delete();

        return $deleted_OrderDetail;
    }
}
