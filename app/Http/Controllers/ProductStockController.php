<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStockLog;
use Illuminate\Http\Request;

class ProductStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $logs = ProductStockLog::paginate(15);
        return view('product-stock.index', compact('logs', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'change_type' => 'required|string',
            'quantity_changed' => 'required|integer',
        ]);

        ProductStockLog::create($request->all());
        if ($request->change_type === 'in') {
            Product::where('id', $request->product_id)
                ->increment('stock', $request->quantity_changed);
        } else {
            Product::where('id', $request->product_id)
                ->decrement('stock', $request->quantity_changed);
        }

        return redirect()->route('product-stock.index')
            ->with('success', 'Product stock log created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
