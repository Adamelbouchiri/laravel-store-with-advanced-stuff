<!-- resources/views/create_product.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#1f2937] flex items-center justify-center min-h-screen">

    <div class="w-full max-w-lg bg-[#111827] p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-white mb-6 text-center">Create a New Product</h2>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Image Input -->
            <div>
                <label for="image" class="block text-gray-300 font-semibold">Product Image</label>
                <input type="file" name="image" id="image" accept="image/*" required
                    class="mt-1 w-full p-2 border border-gray-500 rounded-lg bg-[#1f2937] text-white focus:outline-none focus:ring-2 focus:ring-gray-400">
            </div>

            <!-- Title Input -->
            <div>
                <label for="title" class="block text-gray-300 font-semibold">Title</label>
                <input type="text" name="title" id="title" required
                    class="mt-1 w-full p-2 border border-gray-500 rounded-lg bg-[#1f2937] text-white focus:outline-none focus:ring-2 focus:ring-gray-400">
            </div>

            <!-- Price Input -->
            <div>
                <label for="price" class="block text-gray-300 font-semibold">Price</label>
                <input type="number" name="price" id="price" step="0.01" required
                    class="mt-1 w-full p-2 border border-gray-500 rounded-lg bg-[#1f2937] text-white focus:outline-none focus:ring-2 focus:ring-gray-400">
            </div>

            <!-- Description Input -->
            <div>
                <label for="description" class="block text-gray-300 font-semibold">Description</label>
                <textarea name="description" id="description" rows="4" required
                        class="mt-1 w-full p-2 border border-gray-500 rounded-lg bg-[#1f2937] text-white focus:outline-none focus:ring-2 focus:ring-gray-400"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit"
                        class="w-full bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    Create Product
                </button>
            </div>
        </form>
    </div>

</body>
</html>
