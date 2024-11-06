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
        return view("product.createProduct");
    }

    public function showProducts()
    {
        $products = Product::all();
        return view("product.showProducts", compact("products"));
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
        request()->validate([
            "image" => "required|mimes:png,jpg,jpeg|max:10280",
            "title" => "required",
            "price" => "required|integer",
            "stock" => "required|integer|min:1",
            "description" => "required",
        ]);
        
        $imageFile = $request->image;

        $fileName = hash("sha256", file_get_contents($imageFile)) . "." . $imageFile->getClientOriginalExtension();

        $imageFile->move(public_path("images"), $fileName);

        Product::create([
            "image" => $fileName,
            "title" => $request->title,
            "price" => $request->price,
            "stock" => $request->stock,
            "description" => $request->description,
        ]);

        return back()->with("success", "Product Added Successfully");
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
        
        $product->delete();

        return back()->with('success', 'Product deleted successfully');
    }
}
