<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Reources\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = ProductResource::collection(Product::paginate(20));

        return $products;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:45',
            'description' => 'required|string|max:45',
            'price' => 'required|string|max:45',
            'quantity' => 'required|string|max:45',
        ]);

        $created_product = Product::create($validated);

        return $created_product;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = ProductResource::make($product);

        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:45',
            'description' => 'required|string|max:45',
            'price' => 'required|string|max:45',
            'quantity' => 'required|string|max:45',
        ]);

        $updated_product = $product->update($validated);

        return $updated_product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $deleted_product = $product->delete();

        return $deleted_product;
    }
}
