<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta charset="utf-8">
    <title>Dashboard Owner</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
 
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
    <link href="../assets/css/owner-log.css" rel="stylesheet">

    <!-- Tambahkan jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Tambahkan script DataTables -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Buttons -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

</head>
<body>

    <div class="container-fluid bg-light p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fas fa-file-alt text-primary me-2"></small>
                    <small><a href="{{ route('logs.index') }}" class="">Log</a></small>
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
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('dashboard-owner') }}" class="nav-item nav-link">Beranda</a>
                <a href="{{ route('user-list') }}" class="nav-item nav-link">Daftar Pengguna</a>
                <a href="{{ route('staff-list') }}" class="nav-item nav-link">Daftar Pegawai</a>
                <a href="{{ route('product-list') }}" class="nav-item nav-link">Daftar Produk</a>
                <a href="{{ route('logs.index') }}" class="nav-item nav-link active">Log</a>
                &nbsp; &nbsp;<img class="img-fluid logo-navbar" src="../assets/img/logo.jpeg" alt="">
            </div>
        </div>
    </nav>


    <!-- Log Table Start -->
    <div class="container my-5">
        <h3 class="mb-4">Log Aktivitas Penjualan dan Pembelian</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Action Type</th>
                    <th>Table Name</th>
                    <th>Record ID</th>
                    <th>Old Value</th>
                    <th>New Value</th>
                    <th>User</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($logs as $log)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $log->action_type }}</td>
                        <td>{{ $log->table_name }}</td>
                        <td>{{ $log->record_id }}</td>
                        @if($log->old_value == '[]')
                            <td>NULL</td>
                        @elseif($log->old_value == 'is_fully_paid: 0')
                            <td>Hutang</td>
                        @elseif($log->old_value == 'is_fully_paid: 1')
                            <td>Lunas</td>
                        @else
                            <td>{{ $log->old_value }}</td>
                        @endif
                        @if($log->new_value == '[]')
                        <td>NULL</td>
                        @elseif($log->new_value == 'is_fully_paid: 0')
                            <td>Hutang</td>
                        @elseif($log->new_value == 'is_fully_paid: 1')
                            <td>Lunas</td>
                        @else
                            <td>{{ $log->new_value }}</td>
                        @endif
                        <td>{{ $log->user ? $log->user->name : 'N/A' }}</td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $logs->links() }}
        </div>
    </div>
    <!-- Log Table End -->
    
</body>
</html>