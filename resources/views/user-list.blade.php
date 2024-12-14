<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Daftar Pengguna</title>
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
    <link href="../assets/css/user-list.css" rel="stylesheet">

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
                <small class="fa fa-users text-primary me-2"></small>
                <small><a href="{{ route('user-list') }}" class="">Daftar Pengguna</a></small>
            </div>
            <div class="h-100 d-inline-flex align-items-center py-3">
                <small class="fas fa-user-cog text-primary me-2"></small>
                <small><a href="" class="">Owner</a></small>
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
            <a href="{{ route('dashboard-owner') }}" class="nav-item nav-link">Beranda</a>
            <a href="{{ route('user-list') }}" class="nav-item nav-link active">Daftar Pengguna</a>
            <a href="{{ route('staff-list') }}" class="nav-item nav-link">Daftar Pegawai</a>
            <a href="{{ route('product-list') }}" class="nav-item nav-link">Daftar Produk</a>
            &nbsp; &nbsp;<img class="img-fluid logo-navbar" src="../assets/img/logo.jpeg" alt="">
        </div>
</nav>
<!-- Navbar End -->

<div class="container">

    <!-- Tabel Data -->
    <br><br><div class="table-responsive">
    <h1>Daftar Pengguna</h1>
    <table id="example" class="table table-striped">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>No HP</th>
        <th>Dibuat Pada</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($users as $key => $user)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y H:i') }}</td>
                <td>
                    @if($user->is_active)
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-danger">Tidak Aktif</span>
                    @endif
                </td>
                <td>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li>
                        <a class="dropdown-item" href="{{ route('users.toggleStatus', $user->id) }}">
                            @if($user->is_active)
                                <i class="fas fa-user-slash text-danger"></i>&nbsp; Set Tidak Aktif
                            @else
                                <i class="fas fa-user-check text-success"></i>&nbsp; Set Aktif
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </table>
</div>
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
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
            search: "Cari : &nbsp",
        },
    });
});
    </script>

</body>
</html>