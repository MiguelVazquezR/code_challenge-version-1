<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = ClientResource::collection(Client::paginate(20));

        return $clients;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:45',
            'lastname' => 'required|string|max:45',
            'email' => 'required|string|max:45',
        ]);

        $created_client = Client::create($validated);

        return $created_client;
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $client = ClientResource::make($client);

        return $client;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:45',
            'lastname' => 'required|string|max:45',
            'email' => 'required|string|max:45',
        ]);

        $updated_client = $client->update($validated);

        return $updated_client;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $deleted_client = $client->delete();

        return $deleted_client;
    }
}
