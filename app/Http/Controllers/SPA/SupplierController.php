<?php

namespace App\Http\Controllers\SPA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Supplier/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Supplier/Create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return inertia('Supplier/Show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($supplier_id)
    {
        return inertia('Supplier/Edit', compact('supplier_id'));
    }
}
