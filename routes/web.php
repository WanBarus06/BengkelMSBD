<?php

use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProductsController;
// use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

// Tidak diperlukan, kita pakai satu file saja
// Route::get('/user', function () {
//     return view('user');
// })->name('user');


Route::get('/login-register', function () {
    return view('/login-register');
})->name('/login-register');

Route::get('/products', [ProductsController::class, 'index'])->name('products');

Route::get('/transaction', function () {
    return view('transaction');
})->name('transaction');


Route::get('/dashboard', function () {
    return view('home');
})->name('dashboard');
// Engga semua view butuh controller untuk nampilin filenya
// Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

// Route::get('/products', [ProductsController::class, 'index'])->name('products');

// Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    // Route::post('/cart/add/{product_id}', [CartController::class, 'store'])->name('cart.store');
    // Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    // Route::delete('/cart/{cartItemId}', [CartController::class, 'removeItem'])->name('cart.remove');

});

Route::post('/cart/add/{product_id}', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/{cartItemId}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::Delete('/cart', [CartController::class, 'deleteAllItems'])->name('cart.deleteAllItems');
Route::post('/cart/increase/{cartItemId}', [CartController::class, 'increaseQuantity'])->name('cart.increase');
Route::post('/cart/decrease/{cartItemId}', [CartController::class, 'decreaseQuantity'])->name('cart.decrease');
Route::post('/cart/booking/{cartId}', [CartController::class, 'booking'])->name('cart.booking');


require __DIR__.'/auth.php';