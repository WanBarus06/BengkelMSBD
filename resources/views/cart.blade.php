<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Keranjang</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../assets/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="../assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../assets/css/cart.css" rel="stylesheet">

</head>
<body>

<!-- Topbar Start -->
<div class="container-fluid bg-light p-0">
    <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                <small class="fa fa-home text-primary me-2"></small>
                <small><a href="{{ route('home') }}" class="">Beranda</a></small>
            </div>
            @if (Route::has('login'))
                    @auth
                    <div class="h-100 d-inline-flex align-items-center py-3">
                        <small class="far fa-user text-primary me-2"></small>
                        <small> {{ Auth::user()->name }} </small>
                    </div>
                    @endauth
                @endif
            &nbsp; &nbsp;<div class="h-100 d-inline-flex align-items-center py-3">
                <small class="fas fa-shopping-bag text-primary me-2"></small>
                <small><a href="{{ route('cart.index') }}" class="">Keranjang Saya</a></small>
            </div>
        </div>
    </div>
</div>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<!-- Topbar End -->

<div class="container my-5">
    <h3 class="mb-4">Keranjang Anda</h3>
    <table class="table cart-table">
        <thead class="table-success">
            <tr>
                @if($cart->status == 'Belum Memesan')
                <th>Hapus</th>
                @endif
                <th></th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody id="cart-items">
            @if(isset($cartItems) && $cartItems->isNotEmpty())
            @foreach($cartItems as $item)
            @if($cart->status == 'Belum Memesan')
            <tr class="cart-item">
                <td>
                    <form action="{{ route('cart.destroy', $item->product->product_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm "><i class="fa fa-trash" type="submit"></i></button>
                    </form>
                </td>
            @endif
                <td>
                    <img src="../assets/img/ban.jpeg" alt="Product Image">
                </td>
                <td class="product-info">
                    <strong></strong><br>
                    <small>{{ $item->product->product_name }}</small><br>
                </td>
                <td class="product-price">{{ number_format($item->price, 2) }}</td>
                <td>
                    <div class="quantity-control">
                        @if($cart->status == 'Belum Memesan')
                        <form action="{{ route('cart.decrease', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn decrement">−</button>
                        </form>      
                        @endif       
                        <input type="text" class="form-control quantity" value="{{ $item->quantity }}" readonly>
                        @if($cart->status == 'Belum Memesan')
                        <form action="{{ route('cart.increase', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn increment">+</button>
                        </form>
                        @endif
                    </div>
                </td>
                <td class="product-total">{{ number_format($item->price * $item->quantity)}}</td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="text-center">Keranjang Anda kosong</td>
            </tr>
        @endif    
        </tbody>
    </table>
    <br><br>
    <div class="total-section">
        <h5>Total harga: <span id="total-price">{{ number_format($cartTotal) }}</span></h5>
        <div class="d-flex justify-content-between mt-4">
            @if($cart->status == 'Belum Memesan')
            <form action="{{ route('cart.deleteAllItems') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua produk dari keranjang?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-clear-cart" type="submit">Kosongkan Keranjang</button>
            </form>
            @endif
           
            @if($cart->status == 'Belum Memesan')
                <form action="{{ route('cart.booking', $cart->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Pesan</button>
                </form>
            @else
                <span>Booked</span>
            @endif

        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
// Fungsi untuk menambah jumlah pesanan
document.querySelectorAll('.increment').forEach(button => {
    button.addEventListener('click', function () {
        let input = this.parentElement.querySelector('.quantity');
        let currentValue = parseInt(input.value);
        input.value = currentValue + 1;
        updateProductTotal(this.closest('.cart-item')); // Update total produk
        updateCartTotal(); // Update total keranjang
    });
});

// Fungsi untuk mengurangi jumlah pesanan
document.querySelectorAll('.decrement').forEach(button => {
    button.addEventListener('click', function () {
        let input = this.parentElement.querySelector('.quantity');
        let currentValue = parseInt(input.value);
        if (currentValue > 1) {
            input.value = currentValue - 1;
            updateProductTotal(this.closest('.cart-item')); // Update total produk
            updateCartTotal(); // Update total keranjang
        }
    });
});

// Fungsi untuk mengupdate total produk
function updateProductTotal(cartItem) {
    let price = parseInt(cartItem.querySelector('.product-price').innerText.replace(/[^\d]/g, ''));
    let quantity = parseInt(cartItem.querySelector('.quantity').value);
    let total = price * quantity;

    cartItem.querySelector('.product-total').innerText = formatCurrency(total);
}

// Fungsi untuk menghitung total keranjang
function updateCartTotal() {
    let total = 0;
    document.querySelectorAll('.product-total').forEach(function(item) {
        total += parseInt(item.innerText.replace(/[^\d]/g, ''));
    });
    document.getElementById('total-price').innerText = formatCurrency(total);
}

// Fungsi untuk format mata uang
function formatCurrency(amount) {
    return 'Rp' + amount.toLocaleString();
}

// Menambahkan event listener untuk tombol hapus item
document.querySelectorAll('.remove-item').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.target.closest('.cart-item').remove();
        updateCartTotal(); // Update total keranjang setelah item dihapus
    });
});

// Fungsi untuk mengosongkan keranjang
function clearCart() {
    const cartItems = document.getElementById('cart-items');
    cartItems.innerHTML = '';  // Menghapus semua item dalam keranjang
    updateCartTotal(); // Update total keranjang setelah dikosongkan
    alert('Keranjang Anda telah dikosongkan!');
}
</script>

</body>
</html>