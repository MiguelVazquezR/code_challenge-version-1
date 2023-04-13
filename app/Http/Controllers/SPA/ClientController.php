<?php

namespace App\Http\Controllers\SPA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Client/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Client/Create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return inertia('Client/Show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($client_id)
    {
        return inertia('Client/Edit', compact('client_id'));
    }
}
