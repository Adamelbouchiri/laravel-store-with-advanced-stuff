<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900">
    @include('layouts.navigation')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-100">Products List</h1>
    
    @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Loop through each product -->
        @foreach($products as $product)
            <div class="bg-gray-800 rounded-lg shadow-lg p-4 border border-gray-700 transition-shadow duration-300 hover:shadow-2xl">
                
                <!-- Product Image -->
                <div class="aspect-w-16 aspect-h-9 mb-4">
                    <img src="{{asset('images/'.$product->image) }}" alt="{{ $product->title }}" class="object-cover w-full h-full rounded-lg">
                </div>

                <!-- Product Title and Price -->
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-lg font-semibold text-gray-100">{{ $product->title }}</h2>
                    <span class="text-xl font-bold text-green-400">${{ $product->price }}</span>
                </div>

                <p class="text-lg font-bold text-gray-400 mb-2">stock : {{ $product->stock }}</p>

                <!-- Product Description -->
                <p class="text-gray-400 text-sm mb-4">{{ Str::limit($product->description, 100) }}</p>

                <!-- Add to Cart Button -->
                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div class="form-group">
                        <label for="quantity" class="text-white">Quantity :</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" class="bg-[#1f2937] border-none text-white text-lg focus:outline-none focus:border-none">
                    </div>
                    
                    <button type="submit" class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition-colors duration-200">
                        Add to Cart
                    </button>
                </form>

                @checkRole("admin")
                <form action="{{ route('product.delete', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    
                    <button type="submit" class="mt-4 w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 rounded-lg transition-colors duration-200">
                        Delete product
                    </button>
                </form>
                @endCheckRole
            </div>
        @endforeach
    </div>
</div>

</body>
</html>
