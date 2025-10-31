<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate=$request->validate([
            'name' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'expiration_date'=>'nullable|date',
            'status' => 'required|boolean',
        ]);
        Product::create($validate);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'expiration_date'=>'nullable|date',
            'status' => 'required|boolean',
        ]);

        $product->update($validated);

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }

    public function increase(Product $product)
    {
        $product->increment('quantity'); // +1
        return redirect()->route('products.show', $product)->with('success', 'Quantity increased.');
    }

    public function decrease(Product $product)
    {
        if ($product->quantity > 0) {
            $product->decrement('quantity'); // -1
        }
        return redirect()->route('products.show', $product)->with('success', 'Quantity decreased.');
    }




}

