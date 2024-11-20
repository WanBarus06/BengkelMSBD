<?php

use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\SettingsController;
// use App\Http\Controllers\ProductsController;
// use App\Http\Controllers\TransactionController;
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


Route::get('/products', function () {
    return view('products');
})->name('products');

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

require __DIR__.'/auth.php';