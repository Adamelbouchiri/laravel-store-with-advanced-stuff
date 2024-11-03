<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite("resources/css/app.css")
</head>
<body class="bg-gray-900">

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-100">User List</h1>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
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
                
                <div class="mt-2">
                    <span class="text-xs text-gray-500">Role:</span>
                    @foreach ($user->roles as $role)
                        <span class="text-sm font-medium text-gray-100 bg-gray-700 px-2 py-1 rounded-md">{{ $role->name }}</span>
                    @endforeach
                </div>

                <!-- Delete Button Form -->
                @checkRole("admin")
                <form action="{{ route('users.destroy',  $user->id) }}" method="POST" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 rounded-lg transition-colors duration-200">
                        Delete
                    </button>
                </form>
                <form action="{{ route("users.moderate" ,  $user->id) }}" method="POST" class="mt-4">
                    @csrf
                    @method("PUT")
                    <!-- Submit button for "Turn to Moderator" -->
                    <button type="submit" class="w-full mt-4 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-2 rounded-lg transition-colors duration-200">
                        Turn to Moderator
                    </button>
                </form>
                @endCheckRole
            </div>
        @endforeach
    </div>
</div>

</body>
</html>
