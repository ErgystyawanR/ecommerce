<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Session;
use App\Models\Cart; // Import the CartItem model if not already imported
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function products()
    {
        $products = Product::latest()->get();
        return view('products', compact('products'));
    }

    public function show_product(Product $product)
    {
        return view('show_product', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_product()
    {
        return view('create_product');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_product(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        $file = $request->file('image');
        $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();
        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $path,
        ]);

        // Set pesan flash
        Session::flash('success', 'Product item add successfully.');

        return redirect()->route('products');
    }

    public function update_product(Product $product, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $product->image; // Default path

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('public/' . $path, file_get_contents($file));
        }

        $product->update($request->only(['name', 'price', 'stock', 'description']) + ['image' => $path]);

        // Set pesan flash
        Session::flash('success', 'Product item update successfully.');

        return redirect()->route('products');
    }

    public function edit_product(Product $product)
    {
        return view('edit_product', compact('product'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_product(Product $product)
    {
        $product->delete();

        // Set pesan flash
        Session::flash('success', 'Product item deleted successfully.');
        return redirect()->route('products');
    }
}
