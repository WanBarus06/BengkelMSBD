<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pesanan Offline</title>
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
    <link href="../assets/css/online-order.css" rel="stylesheet">

    <!-- Tambahkan link CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

    <!-- Tambahkan jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Tambahkan script DataTables -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                    <small><a href="{{ route('orders.index') }}" class="">Pesanan Offline</a></small>
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
                <a href="{{ route('orders.index') }}" class="nav-item nav-link ">Pesanan Online</a>
                <a href="{{ route('orders.onsite') }}" class="nav-item nav-link active">Pesanan Offline</a>
                <a href="{{ route('transaction-history-staff') }}" class="nav-item nav-link">Riwayat Transaksi</a>
                <a href="" class="nav-item nav-link">Faktur Pembelian</a>
                &nbsp; &nbsp;<img class="img-fluid logo-navbar" src="../assets/img/logo.jpeg" alt="">
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <div class="container mt-4"> <!-- Padding top tambahan untuk pemisah antar bagian -->
        <h3>Detail Pesanan</h3>
        <table class="table table-bordered">
            <tr>
                <th>Nama Pembeli</th>
                <td>
                @if($sale->customer_id)
                    {{ $sale->user->name }} <!-- Jika ada user_id, ambil nama dari relasi user -->
                @else
                    {{ $sale->offline_customer_name }} <!-- Jika tidak ada user_id, ambil dari kolom offline_customer_name -->
                @endif
                </td>
            </tr>
            <tr>
                <th>No Hp</th>
                <td>
                @if($sale->customerr_id)
                    {{ $sale->user->phone_number }} <!-- Jika ada user_id, ambil no hp dari relasi user -->
                @else
                    {{ $sale->offline_customer_phone_number }} <!-- Jika tidak ada user_id, ambil dari kolom offline_customer_phone_number -->
                @endif
                </td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $sale->offline_customer_address }}</td>
            </tr>

            <tr>
                <th>Total Pembayaran</th>
                <td>{{ number_format($totalAmount, 2) }}</td>
            </tr>
            <tr>
                <th>Waktu Pesanan</th>
                <td>{{ $sale->created_at }}</td>
            </tr>
        </table>

        <h4 class="mt-5">Daftar Produk yang Dibeli</h4> <!-- Menambah jarak dengan margin-top -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Kuantitas</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                <tr>
                    <td>{{ $item->product->product_name }}</td>
                    <td>{{ number_format($item->price_per_unit, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price_per_unit * $item->quantity) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tombol aksi berdasarkan status pesanan -->
        @if ($sale->is_fully_paid == FALSE)
       <!-- Tombol Lunas Hutang -->
            <form id="confirm-order-form" action="{{ route('offline-orders.paid', $sale->sales_id) }}" method="POST" class="d-inline">
                @csrf
                <button type="button" id="confirm-order-button" class="btn btn-success">Lunas</button>
            </form>
        @endif
    </div>
    <script> 
    // SweetAlert untuk Konfirmasi Pesanan
    $('#confirm-order-button').on('click', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Aksi ini tidak akan bisa diulang?',
            text: "Pastikan anda yakin!.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Konfirmasi!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#confirm-order-form').submit(); // Kirim form konfirmasi
            }
        });
    });
    

        $('#confirm-order-button').on('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Lunaskan pesanan?',
                text: "Aksi ini tidak akan bisa diulang.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Konfirmasi!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#confirm-order-form').submit(); // Kirim form konfirmasi
                }
            });
        });

        // SweetAlert untuk Penolakan Pesanan
       // SweetAlert untuk Penolakan Pesanan
$('#reject-order-button').on('click', function (e) {
    e.preventDefault();
    Swal.fire({
        title: 'Tolak Pesanan?',
        input: 'textarea',
        inputLabel: 'Berikan alasan penolakan',
        inputPlaceholder: 'Masukkan alasan...',
        inputAttributes: {
            'aria-label': 'Masukkan alasan'
        },
        showCancelButton: true,
        confirmButtonText: 'Tolak Pesanan',
        cancelButtonText: 'Batal',
        inputValidator: (value) => {
            if (!value) {
                return 'Alasan penolakan tidak boleh kosong!';
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Tambahkan alasan penolakan ke form sebelum submit
            $('<input>').attr({
                type: 'hidden',
                name: 'reason',  // Ganti 'remarks' dengan 'reason' agar masuk ke cancelled_reason
                value: result.value
            }).appendTo('#reject-order-form');

            $('#reject-order-form').submit(); // Kirim form penolakan
        }
    });
});


    </script>
    
</body>
</html>
