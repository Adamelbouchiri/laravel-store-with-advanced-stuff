<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\usersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/products', [ProductController::class, "showProducts"])->name("product.show");
    Route::post('/cart/store', [CartController::class, "store"])->name("cart.store");
    Route::get('/cart', [CartController::class, "index"])->name("cart.show");
    Route::delete('/cart/destroy/{user}', [CartController::class, "destroy"])->name("cart.delete");
    Route::put('/cart/increase/{item}', [CartController::class, "increase"])->name("cart.increase");
    Route::put('/cart/decrease/{item}', [CartController::class, "decrease"])->name("cart.decrease");
    Route::get('/cart/pay', [CartController::class, "pay"])->name("cart.pay");
});


Route::middleware(['auth', "role:admin,moderator"])->group(function () {
    Route::get('/product/create', [ProductController::class, "index"])->name("product.create");
    Route::post('/product/store', [ProductController::class, "store"])->name("product.store");
    Route::delete('/product/destroy/{product}', [ProductController::class, "destroy"])->name("product.delete");
    Route::get('/users', [usersController::class, "index"])->name("users.show");
    
});

Route::middleware(['auth', "role:admin"])->group(function () {
    Route::put('/users/update/{user}', [usersController::class, "update"])->name("users.moderate");
    Route::delete('/users/delete/{user}', [usersController::class, "destroy"])->name("users.destroy");
    Route::get('/users/trashed', [usersController::class, "trashedUsers"])->name("trashedUsers.show");
    Route::post('/users/restore/{id}', [usersController::class, 'restore'])->name('users.restore');
    
});

require __DIR__.'/auth.php';
