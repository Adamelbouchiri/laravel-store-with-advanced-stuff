<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>cart</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#111827]">
<div class="container mx-auto p-4 bg-[#111827]">
    <h2 class="text-2xl font-semibold mb-6 text-white">Shopping Cart</h2>

    @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

    <!-- Cart Items List -->
    @if($user->products->isEmpty())
        <p class="text-gray-400">Your cart is currently empty.</p>
    @else

        <div class="space-y-4">
            <!-- Loop through each item in the cart -->
            @foreach($user->products as $item)
                <div class="flex flex-col md:flex-row items-center justify-between bg-gray-800 p-4 shadow rounded-lg">
                    <!-- Product Image -->
                    <img src="{{ asset('images/'. $item->image) }}" alt="{{ $item->name }}" class="w-24 h-24 object-cover rounded-lg mr-4">

                    <!-- Product Details -->
                    <div class="flex-1 ml-4">
                        <h3 class="text-lg font-semibold text-white">{{ $item->name }}</h3>
                        <p class="text-gray-400 mt-1">{{ $item->description }}</p>
                    </div>

                    <!-- Quantity and Price -->
                    <div class="flex items-center mt-4 md:mt-0 space-x-4">
                        <!-- Quantity Selector -->
                        <div class="flex items-center space-x-2">
                            <!-- Decrease quantity button -->
                            <form action="" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600">-</button>
                            </form>

                            <!-- Quantity display/input -->
                            <input type="number" value="{{ $item->pivot->quantity }}" min="1" class="w-12 text-center border border-gray-600 bg-gray-900 text-gray-200 rounded-lg" readonly>

                            <!-- Increase quantity button -->
                            <form action="{{ route('cart.increase', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="px-3 py-1 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600">+</button>
                            </form>
                        </div>

                        <!-- Price -->
                        <p class="text-lg font-semibold text-white">${{ number_format($item->price * $item->pivot->quantity, 2) }}</p>
                    </div>

                    <!-- Remove Button -->
                    <form action="{{ route("cart.delete", $user->id) }}" method="POST" class="ml-4 mt-4 md:mt-0">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" value="{{ $item->id }}" name="product_id">
                        <input type="hidden" value="{{ $item->pivot->quantity }}" name="quantity">
                        <button type="submit" class="text-red-500 hover:text-red-700">Remove</button>
                    </form>
                </div>
            @endforeach
        </div>

        <!-- Cart Summary -->
        <div class="mt-6 p-4 bg-gray-900 rounded-lg shadow-lg">
            <div class="flex justify-between mb-2">
                <span class="text-gray-300">Subtotal</span>
                <span class="font-semibold text-gray-100">
                    ${{ number_format($user->products->sum(fn($item) => $item->price * $item->pivot->quantity), 2) }}
                </span>
            </div>
            <div class="flex justify-between mb-2">
                <span class="text-gray-300">Shipping</span>
                <span class="font-semibold text-gray-100">$5.00</span>
            </div>
            <div class="flex justify-between mb-4">
                <span class="text-gray-300">Tax</span>
                <span class="font-semibold text-gray-100">$3.50</span>
            </div>
            <div class="border-t border-gray-700 pt-4 flex justify-between">
                <span class="text-lg font-semibold text-white">Total</span>
                <span class="text-lg font-semibold text-white">
                    ${{ number_format($user->products->sum(fn($item) => $item->price * $item->pivot->quantity) + 5.00 + 3.50, 2) }}
                </span>
            </div>

            <!-- Checkout Button -->
            <button class="mt-6 w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700">
                Proceed to Checkout
            </button>
        </div>
    @endif
</div>

</body>
</html>
