<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(["resources/css/app.css", "resources/js/app.js"])
</head>
<body class="bg-gray-900">
@include('layouts.navigation')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-100">Trashed Users List</h1>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($users as $user)
            <div class="bg-gray-800 rounded-lg shadow-lg p-6 border border-gray-700 transition-shadow duration-300 hover:shadow-2xl">
                <h2 class="text-xl font-semibold text-gray-100">{{ $user->name }}
                @foreach ($user->roles as $role)
                    @if ($role->name == "admin")
                    <span class="text-yellow-500"><i class="fa-solid fa-star"></i></span>
                    @endif
                @endforeach
                </h2>
                <p class="text-gray-400 text-sm">{{ $user->email }}</p>
                
                <div class="mt-4">
                    <span class="text-xs text-gray-500">Created At:</span>
                    <span class="text-sm text-gray-300">{{ $user->created_at->format('M d, Y') }}</span>
                </div>

                <div class="mt-4">
                    <span class="text-xs text-gray-500">Deleted At:</span>
                    <span class="text-sm text-gray-300">{{ $user->deleted_at->format('M d, Y') }}</span>
                </div>
                
                <div class="mt-2">
                    <span class="text-xs text-gray-500">Role:</span>
                    @foreach ($user->roles as $role)
                        <span class="text-sm font-medium text-gray-100 bg-gray-700 px-2 py-1 rounded-md">{{ $role->name }}</span>
                    @endforeach
                </div>

                @checkRole("admin")
                <form action="{{ route('users.restore', $user->id) }}" method="POST" class="mt-4">
                    @csrf
                    
                    <button type="submit" class="w-full mt-4 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-lg transition-colors duration-200">
                        Restore
                    </button>
                </form>
                @endCheckRole
            </div>
        @endforeach
    </div>
</div>

</body>
</html>
