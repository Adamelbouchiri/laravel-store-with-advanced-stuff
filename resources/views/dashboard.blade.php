<x-app-layout>
    <x-slot name="header" class="flex">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @checkRole("admin")
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in! as Admin") }}
                </div>
            </div>
            <div class="flex gap-8 mt-4 ms-4">
                <a href="{{ route("product.create") }}" class="font-semibold text-l  hover:text-gray-400 duration-300 text-gray-800 dark:text-gray-200 leading-tight">Create Products</a>
                <a href="{{ route("users.show") }}" class="font-semibold text-l hover:text-gray-400 duration-300 text-gray-800 dark:text-gray-200 leading-tight">Show Users</a>
                <a href="{{ route("product.show") }}" class="font-semibold text-l hover:text-gray-400 duration-300 text-gray-800 dark:text-gray-200 leading-tight">Show Products</a>
                <a href="{{ route('trashedUsers.show') }}" class="font-semibold text-l hover:text-gray-400 duration-300 text-gray-800 dark:text-gray-200 leading-tight">Show Deleted Users</a>
            </div>
        </div>
    </div>
    @endCheckRole

    @checkRole("moderator")
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in! as Moderator") }}
                </div>
            </div>
            <div class="flex gap-8 mt-4 ms-4">
                <a href="{{ route("product.create") }}" class="font-semibold text-l  hover:text-gray-400 duration-300 text-gray-800 dark:text-gray-200 leading-tight">Create Products</a>
                <a href="{{ route("users.show") }}" class="font-semibold text-l hover:text-gray-400 duration-300 text-gray-800 dark:text-gray-200 leading-tight">Show Users</a>
                <a href="{{ route("product.show") }}" class="font-semibold text-l hover:text-gray-400 duration-300 text-gray-800 dark:text-gray-200 leading-tight">Show Products</a>
            </div>
        </div>
    </div>
    @endCheckRole

    @checkRole("user")
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in! as User") }}
                </div>
            </div>
            <div class="flex gap-8 mt-4 ms-4">
                <a href="{{ route("product.show") }}" class="font-semibold text-l hover:text-gray-400 duration-300 text-gray-800 dark:text-gray-200 leading-tight">Show Products</a>
                <a href="{{ route("cart.show") }}" class="font-semibold text-l hover:text-gray-400 duration-300 text-gray-800 dark:text-gray-200 leading-tight">My Cart</a>
            </div>
        </div>
    </div>
    @endCheckRole

</x-app-layout>
