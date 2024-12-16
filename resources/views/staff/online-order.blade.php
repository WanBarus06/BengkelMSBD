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
            <a href="{{ route('suppliers.index') }}" class="nav-item nav-link">Supplier</a>
            <a href="{{ route('orders.index') }}" class="nav-item nav-link active">Pesanan Online</a>
            <a href="{{ route('orders.onsite') }}" class="nav-item nav-link">Pesanan Offline</a>
            <a href="{{ route('purchase-invoice.index') }}" class="nav-item nav-link">Faktur Pembelian</a>
            &nbsp; &nbsp;<img class="img-fluid logo-navbar" src="../assets/img/logo.jpeg" alt="">
        </div>
</nav>
<!-- Navbar End -->

<div class="container">

    <!-- Tabel Data -->
    <br><br><div class="table-responsive">
    <h1>Pesanan Online</h1>
   <!-- Form Pencarian dan Pilihan Jumlah Baris per Halaman -->
<!-- Form Pencarian dan Pilihan Jumlah Baris per Halaman -->
<form action="{{ route('orders.index') }}" method="GET">
    <div class="row mb-3">
        <div class="col">
            <input type="text" name="search" class="form-control" placeholder="Cari nama atau status..." value="{{ request('search') }}">
        </div>
        <div class="col">
            <select name="rows_per_page" class="form-control" onchange="this.form.submit()">
                <option value="10" {{ request('rows_per_page') == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('rows_per_page') == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('rows_per_page') == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ request('rows_per_page') == 100 ? 'selected' : '' }}>100</option>
            </select>
        </div>
    </div>
</form>

<table id="example" class="table table-striped">
    <thead>
        <tr>
            <th class="text-center">
                <a href="{{ route('orders.index', ['search' => request('search'), 'sort_by' => 'id', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc', 'rows_per_page' => request('rows_per_page')]) }}">
                    No
                </a>
            </th>
            <th class="text-center">
                <a href="{{ route('orders.index', ['search' => request('search'), 'sort_by' => 'user.name', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc', 'rows_per_page' => request('rows_per_page')]) }}">
                    Nama Pembeli
                </a>
            </th>
            <th class="text-center">
                <a href="">
                    No Hp
                </a>
            </th>
            <th class="text-center">
                <a href="">
                    Total
                </a>
            </th>
            <th class="text-center">
                <a href="{{ route('orders.index', ['search' => request('search'), 'sort_by' => 'status', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc', 'rows_per_page' => request('rows_per_page')]) }}">
                    Status
                </a>
            </th>
            <th class="text-center">
                <a href="{{ route('orders.index', ['search' => request('search'), 'sort_by' => 'updated_at', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc', 'rows_per_page' => request('rows_per_page')]) }}">
                    Waktu
                </a>
            </th>
            <th class="text-center">
                <a href="{{ route('orders.index', ['search' => request('search'), 'sort_by' => 'updated_at', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc', 'rows_per_page' => request('rows_per_page')]) }}">
                    Kode
                </a>
            </th>
            <th class="text-center">
                <a href="">
                    Detail Pesanan
                </a>
            </th>
        </tr>
    </thead>    
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user->name }}</td>
            <td>{{ $order->user->phone_number }}</td>
            <td>{{ number_format($order->total_amount, 2) }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->updated_at }}</td>
            <td>{{ $order->pickup_code }}</td>
            <td class="text-center">
                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-danger">LIHAT</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination Links -->
<div class="pagination justify-content-center">
    {{ $orders->appends(request()->input())->links('pagination::bootstrap-4') }}
</div>



</div>
</div>
</body>
</html>