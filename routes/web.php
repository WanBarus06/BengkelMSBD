<?php

use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OfflineOrderController;
use App\Http\Controllers\SupplierController;
use App\Http\Middleware\StaffMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about'); 

// Tidak diperlukan, kita pakai satu file saja
// Route::get('/user', function () {
//     return view('user');
// })->name('user');

Route::get('/login-register', function () {
    return view('/login-register');
})->name('/login-register');

Route::get('/products', [ProductsController::class, 'index'])->name('products');

Route::get('/dashboard-owner', function () {
    return view('dashboard-owner');
})->name('dashboard-owner'); 

Route::get('/dashboard', function () {
    return view('home');
})->name('dashboard');
// Engga semua view butuh controller untuk nampilin filenya
// Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

// Route::get('/products', [ProductsController::class, 'index'])->name('products');

Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{product_id}', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/{cartItemId}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::delete('/cart', [CartController::class, 'deleteAllItems'])->name('cart.deleteAllItems');
    Route::post('/cart/increase/{cartItemId}', [CartController::class, 'increaseQuantity'])->name('cart.increase');
    Route::post('/cart/decrease/{cartItemId}', [CartController::class, 'decreaseQuantity'])->name('cart.decrease');
    Route::post('/cart  /booking/{cartId}', [CartController::class, 'booking'])->name('cart.booking');
});

Route::middleware(['auth', StaffMiddleware::class])->group(function () {
    // Rute yang hanya dapat diakses oleh pengguna dengan peran 'staff'
    Route::resource('suppliers', SupplierController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('offline-orders', OfflineOrderController::class);
    Route::get('/onsite-order', function () {
        return view('staff.onsite-order');
    })->name('onsite-order'); 
    
    Route::get('/transaction-history-staff', function () {
        return view('staff.transaction-history-staff');
    })->name('transaction-history-staff'); 

    Route::post('/orders/{cart}/confirm', [OrderController::class, 'confirmOrder'])->name('orders.confirm');
    Route::post('/orders/{cart}/reject', [OrderController::class, 'rejectOrder'])->name('orders.reject');
    Route::get('/offline-orders/create/', [OrderController::class, 'createOrGetCart'])->name('orders.createOrGetCart');
    Route::post('/offline-orders/complete/{cartId}', [OfflineOrderController::class, 'completeOrder'])->name('offline-orders.completeOrder');
    Route::delete('/offline-orders/cart/{cartId}', [OfflineOrderController::class, 'destroy'])->name('offline-orders.deleteOrder');
    Route::post('/offline-orders/{cart_id}', [OfflineOrderController::class, 'store'])->name('offline-orders.store');
    Route::post('/offline-orders/paid/{saleId}', [OfflineOrderController::class, 'paid'])->name('offline-orders.paid');
    Route::post('/suppliers/{supplier}/activate', [SupplierController::class, 'activate'])->name('suppliers.activate');
    Route::get('/onsite-order', [OrderController::class, 'indexOnsite'])->name('orders.onsite');   
    
    
});
require __DIR__.'/auth.php';