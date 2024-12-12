<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pesanan Online</title>
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

    <!-- Tambahkan SweetAlert2 CDN di bagian <head> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
                <small><a href="{{ route('orders.index') }}" class="">Pesanan Online</a></small>
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
                <a href="{{ 'suppliers.index' }}" class="nav-item nav-link active">Supplier</a>
                <a href="{{ route('orders.index') }}" class="nav-item nav-link">Pesanan Online</a>
                <a href="{{ route('onsite-order') }}" class="nav-item nav-link">Pesanan Offline</a>
                <a href="{{ route('transaction-history-staff') }}" class="nav-item nav-link">Riwayat Transaksi</a>
                <a href="" class="nav-item nav-link">Faktur Pembelian</a>
                &nbsp; &nbsp;<img class="img-fluid logo-navbar" src="../assets/img/logo.jpeg" alt="">
            </div>
    </nav>
<!-- Navbar End -->

<!-- Tabel Data -->
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="container mt-5">
    <h1>Manajemen Pemasok Barang</h1>
    
    <!-- Form Input Supplier -->
    <form method="POST" action="{{ route('suppliers.store') }}">
        @csrf
        <div class="mb-3">
            <label for="supplier_name" class="form-label">Supplier Name</label>
            <input type="text" class="form-control" id="supplier_name" name="supplier_name" required>
            @error('supplier_name')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="number" class="form-control" id="phone_number" name="phone_number" required>
            @error('phone_number')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
            @error('address')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Tambahkan</button>
    </form>

    <hr>

    <!-- Tabel Supplier -->
    <h2>Daftar Pemasok Barang</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Supplier Name</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $supplier->supplier_name }}</td>
                    <td>{{ $supplier->phone_number }}</td>
                    <td>{{ $supplier->address }}</td>
                    <td>{{ $supplier->is_active ? 'Aktif' : 'Tidak Aktif' }}</td>
                    <td>
                        @if ($supplier->is_active)
                        <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" id="deleteForm{{ $supplier->supplier_id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $supplier->supplier_id }})">Nonaktifkan</button>
                        </form>
                        @else
                        <form action="{{ route('suppliers.activate', $supplier) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Aktifkan</button>
                        </form>
                        @endif                     
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    function confirmDelete(supplierId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Supplier ini akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna klik "Ya, hapus!", submit form
                document.getElementById('deleteForm' + supplierId).submit();
            }
        });
    }
</script>
</body>
</html>