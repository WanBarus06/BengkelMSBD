<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OfflineOrderController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseInvoiceController;
use App\Http\Middleware\StaffMiddleware;
use App\Http\Middleware\OwnerMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\productListController;
use App\Http\Controllers\dashboardOwnerController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\DB; 

use App\Models\User;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Size;
use App\Models\Variant;
use App\Models\ProductDescription;
use App\Models\ProductDetail;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about'); 

Route::get('/login-register', function () {
    return view('/login-register');
})->name('/login-register');

Route::get('/products', [ProductsController::class, 'index'])->name('products');

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

Route::get('/cart/{cartId}', [TransactionController::class, 'show'])->name('transaction.show');

Route::middleware(['auth', StaffMiddleware::class])->group(function () {
    // Rute yang hanya dapat diakses oleh pengguna dengan peran 'staff'
    Route::resource('suppliers', SupplierController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('offline-orders', OfflineOrderController::class);
    Route::resource('purchase-invoice', PurchaseInvoiceController::class);
    
    Route::get('/transaction-history-staff', function () {
        return view('staff.transaction-history-staff');
    })->name('transaction-history-staff'); 

    Route::post('/orders/{cart}/confirm', [OrderController::class, 'confirmOrder'])->name('orders.confirm');
    Route::post('/orders/{cart}/reject', [OrderController::class, 'rejectOrder'])->name('orders.reject');
    Route::post('/orders/{cartId}/complete', [OrderController::class, 'completeOrder'])->name('orders.complete');
    Route::get('/offline-orders/create/', [OrderController::class, 'createOrGetCart'])->name('orders.createOrGetCart');
    Route::get('/onsite-order', [OrderController::class, 'indexOnsite'])->name('orders.onsite');   
    Route::post('/offline-orders/complete/{cartId}', [OfflineOrderController::class, 'completeOrder'])->name('offline-orders.completeOrder');
    Route::delete('/offline-orders/cart/{cartId}', [OfflineOrderController::class, 'destroy'])->name('offline-orders.deleteOrder');
    Route::post('/offline-orders/{cart_id}', [OfflineOrderController::class, 'store'])->name('offline-orders.store');
    Route::post('/offline-orders/paid/{saleId}', [OfflineOrderController::class, 'paid'])->name('offline-orders.paid');
    Route::post('/suppliers/{supplier}/activate', [SupplierController::class, 'activate'])->name('suppliers.activate');
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::post('/purchase-invoice/complete/{cartId}', [PurchaseInvoiceController::class, 'confirmInvoice'])->name('purchase-invoice.confirm');
    Route::post('/purchase-invoice/cart/{cartId}', [PurchaseInvoiceController::class, 'store'])->name('purchase-invoice.store');
    Route::get('/transactions/today', [TransactionController::class, 'staffIndex'])->name('transactions.today');
    Route::get('/purchase-history', [TransactionController::class, 'staffPurchase'])->name('purchase.today');
});

Route::middleware(['auth', OwnerMiddleware::class])->group(function () {
    // Rute yang hanya dapat diakses oleh pengguna dengan peran 'owner'
    Route::get('/dashboard-owner', [dashboardOwnerController::class, 'dashboardOwner'])->name('dashboard-owner');

    Route::get('/api/dashboard-data', function () {
        return response()->json([
            'jumlahPengguna' => User::where('role', 'user')->where('is_active', '1')->count(),
            'jumlahPegawai' => User::where('role', 'staff')->where('is_active', '1')->count(),
            'jumlahProduk' => Product::where('is_active', '1')->count(),
        ]);
        });

    Route::get('/user-list', [UserController::class, 'index'])->name('user-list');
    Route::get('/users/toggle-status/{id}', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
    
    Route::get('/staff-list', function () {
        $users = User::where('role', 'staff')->get(); // Mengambil semua data pengguna dari model User
        return view('staff-list', compact('users')); // Mengirimkan data ke view
    })->name('staff-list');
    Route::get('/staff/toggle-status/{id}', [StaffController::class, 'toggleStatus'])->name('staff.toggleStatus');
    Route::put('/staff/update/{id}', [StaffController::class, 'update'])->name('staff.update');
    Route::post('/staff/add', [StaffController::class, 'addStaff'])->name('staff.add');

    //Daftar Produk
    Route::get('/product-list', [productListController::class, 'index'])->name('product-list');
    Route::get('/product/{id}', [productListController::class, 'show'])->name('owner-product.show');
    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
    // In your routes file
    Route::get('/add-product', [productListController::class, 'indexAddProduct'])->name('add.product');
    Route::put('/product/{id}', [productListController::class, 'update'])->name('product-update');
    Route::patch('/product/{id}/status', [productListController::class, 'toggleStatus'])->name('product.status');
    Route::post('/product/add', [productListController::class, 'store'])->name('product.store');

    Route::get('/get-products', [productListController::class, 'getProducts'])->name('get-products');

    Route::get('/api/products', function () {
        $products = Product::where('is_active', '1')->get();
        return response()->json($products);
    });
    
});

require __DIR__.'/auth.php';