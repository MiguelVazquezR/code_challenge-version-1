<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = OrderResource::collection(Order::all());

        return $orders;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_number' => 'required|string|max:45',
            'status_id' => 'required',
            'client_id' => 'required',
        ]);

        $created_order = Order::create($validated);

        return $created_order;
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order = orderResource::make($order);

        return $order;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'order_number' => 'required|string|max:45',
            'status_id' => 'required',
            'client_id' => 'required',
        ]);

        $updated_order = $order->update($validated);

        return $updated_order;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $deleted_order = $order->delete();

        return $deleted_order;
    }
}
