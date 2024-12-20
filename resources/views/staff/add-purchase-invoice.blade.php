<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Faktur Pembelian</title>
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
    <link href="../assets/css/pending-order.css" rel="stylesheet">

    <!-- Tambahkan link CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

    <!-- Tambahkan jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Tambahkan script DataTables -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
</head>
<body>

    <!-- Topbar Start -->
    <div class="container-fluid bg-light p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fas fa-user-tie text-primary me-2"></small>
                    <small><a href="" class="">Staff</a></small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3">
                    <small class="fas fa-cart-arrow-down text-primary me-2"></small>
                    <small><a href="{{ route('orders.onsite') }}" class="">Pesanan Ditempat</a></small>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-car me-3"></i>Bengkel Panbres</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('suppliers.index') }}" class="nav-item nav-link">Supplier</a>
                <a href="{{ route('orders.index') }}" class="nav-item nav-link">Pesanan Online</a>
                <a href="{{ route('orders.onsite') }}" class="nav-item nav-link">Pesanan Offline</a>
                <a href="{{ route('purchase-invoice.index') }}" class="nav-item nav-link active">Faktur Pembelian</a>
                <a href="{{ route('transactions.today') }}" class="nav-item nav-link" >Penjualan</a>
                &nbsp; &nbsp;<img class="img-fluid logo-navbar" src="../assets/img/logo.jpeg" alt="">
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Menampilkan pesan sukses atau error -->
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="container mt-4">
        <h1>Masukkan Faktur Pembelian</h1>
        <!-- Input Produk ke Keranjang -->
        <form action="{{ route('purchase-invoice.store', $cart->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="product_id" class="form-label">Pilih Produk</label>
                <select name="product_id" id="product_id" class="form-control" required>
                    @foreach($products as $product)
                        <option value="{{ $product->product_id }}">
                            {{ $product->product_name }} - Rp{{ number_format($product->productDetail->product_sell_price, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label for="quantity" class="form-label">Kuantitas</label>
                <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>

        <!-- List Produk di Keranjang -->
        <h3 class="mt-4">Produk</h3>
        @if($cartItems->isEmpty())
        <p>Belum ada produk</p>
        @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Kuantitas</th>
                    <th>Harga pcs</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                <tr>
                    <td>{{ $item->product->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp{{ number_format($item->price, 2) }}</td>
                    <td>Rp{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        <!-- Selesaikan Pesanan -->
       <!-- Selesaikan Pesanan -->
    <form action="{{ route('purchase-invoice.confirm', $cart->id) }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-3">
            <label for="product_id" class="form-label">Pilih Supplier</label>
                <select name="supplier_id" id="product_id" class="form-control" required>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->supplier_id }}">
                            {{ $supplier->supplier_name }}
                        </option>
                    @endforeach
                </select>
        </div>
        <button type="submit" class="btn btn-success">Selesaikan Faktur</button>
    </form>
{{-- 
    <form id="delete-form" action="{{ route('offline-orders.destroy', $cart->id) }}" method="POST" ">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="confirmReject()">Batalkan Pesanan</button>
    </form>  --}}
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
         function confirmReject() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Pesanan akan dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, batalkan!',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form').submit();
                }
            });
        }

        $(document).ready(function () {
            $('#example').DataTable({
                paging: true, // Mengaktifkan pagination
                searching: true, // Mengaktifkan search box
                info: true, // Menampilkan informasi jumlah data
                lengthMenu: [10, 25, 50, 100], // Opsi jumlah entri per halaman
                language: {
                    lengthMenu: "Tampilkan &nbsp _MENU_ &nbsp data per halaman",
                    info: "Menampilkan _START_ data sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        next: "Selanjutnya",
                        previous: "Sebelumnya",
                    },
                    search: "Search: &nbsp",
                },
            });
        });
    </script>
</body>
</html>
