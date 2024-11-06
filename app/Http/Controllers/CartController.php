<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return view("cart.carts", compact("user"));
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
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::where('id',  $request->product_id)->first();


        if($product) {
            $product->stock -=  $request->quantity;
            $product->save();
        }

        $user = User::where("id", Auth::user()->id)->first();
        $productId = $request->product_id;
        $quantity = $request->quantity;

        if ($user->products()->where('product_id', $productId)->exists()) {
            $user->products()->updateExistingPivot($productId, ['quantity' => $quantity]);
        } else {
            // Add the product to the cart with the specified quantity
            $user->products()->attach($productId, ['quantity' => $quantity]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    /**
     * Display the specified resource.
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request ,User $user)
    {
        request()->validate([
            "product_id" => "required",
            "quantity" => "required",
        ]);

        $product = Product::where('id',  $request->product_id)->first();


        if($product) {
            $product->stock +=  $request->quantity;
            $product->save();
        }

        $user = User::where("id", Auth::user()->id)->first();
        $productId = $request->product_id;

        $user->products()->detach($productId);

        return back()->with("success", "Item removed Successfully");
    }
}
