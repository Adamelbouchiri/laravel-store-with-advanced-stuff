<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Stripe;

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
    public function increase(Product $item)
    {
        $cart = Cart::where('product_id', $item->id)
            ->where('user_id', Auth::user()->id) // Add additional condition here
            ->first();

        $product = Product::where('id', $item->id)->first();
        
        if($cart) {
            $cart->quantity += 1;
            $cart->save();

            $product->stock -= 1;
            $product->save();
        }

        return back()->with('success', 'Quantity increased successfully');

    }

    public function decrease(Product $item)
    {
        
        $cart = Cart::where('product_id', $item->id)
            ->where('user_id', Auth::user()->id) // Add additional condition here
            ->first();

        $product = Product::where('id', $item->id)->first();
        
        if($cart) {
            $cart->quantity -= 1;
            $cart->save();

            $product->stock += 1;
            $product->save();
        }

        return back()->with('success', 'Quantity decreased successfully');

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

    public function pay() {

        $carts = cart::where("user_id", Auth::user()->id)->get();
        $total = 0;
        $products = [];

        foreach ($carts as $cart) {
            $product = Product::where('id', $cart->product_id)->first();
            $total += $product->price * $cart->quantity;
            $products[] = $product;
        }

        dd($total);
        
        Stripe::setApiKey(config('stripe.sk'));
        
        $session = Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'usd',
                        'product_data' => [
                            "name" => "LionsGeek Product",
                            "description"=> "nyehehehehe"
                        ],
                        'unit_amount'  => 6900,
                    ],
                    'quantity'   => 2,
                ],

            ],
            'mode'        => 'payment', // the mode  of payment
            'success_url' => route('dashboard'), // route when success 
            'cancel_url'  => route('dashboard'), // route when  failed or canceled
        ]);

        return redirect()->away($session->url);
    }
}
