<?php

namespace App\Http\Controllers\SPA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Order/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Order/Create');
    }

    /**
     * Display the specified resource.
     */
    public function show($order_id)
    {
        return inertia('Order/Show', compact('order_id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($order_id)
    {
        return inertia('Order/Edit', compact('order_id'));
    }
}
