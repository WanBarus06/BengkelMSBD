<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta charset="utf-8">
    <title>Dashboard Owner</title>
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
    <link href="../assets/css/dashboard-owner.css" rel="stylesheet">

    <!-- Tambahkan link CSS DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

<!-- Tambahkan jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Tambahkan script DataTables -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<style>
    /* Responsiveness */
    @media (max-width: 768px) {
        .summary {
            flex-direction: column;
        }

        .content,
        .orders {
            flex-direction: column;
        }

        .card,
        .recent-orders,
        .product-container {
            margin-bottom: 15px;
        }

        .navbar-brand h2 {
            font-size: 20px;
        }
    }

    @media (max-width: 576px) {
        .navbar {
            padding: 10px;
        }

        .summary .card {
            text-align: center;
            font-size: 14px;
        }

        .product-item img {
            width: 100px;
        }
    }
</style>
</head>
<body>

     <!-- Topbar Start -->
     <div class="container-fluid bg-light p-0">
    <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                <small class="fa fa-home text-primary me-2"></small>
                <small><a href="{{ route('dashboard-owner') }}" class="">Beranda</a></small>
            </div>
            <div class="h-100 d-inline-flex align-items-center py-3">
                <small class="fas fa-user-cog text-primary me-2"></small>
                <small><a href="{{ route('dashboard-owner') }}" class="">Owner</a></small>
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
            <a href="{{ route('dashboard-owner') }}" class="nav-item nav-link active">Beranda</a>
            <a href="" class="nav-item nav-link">Daftar Pengguna</a>
            <a href="" class="nav-item nav-link">Daftar Pegawai</a>
            <a href="" class="nav-item nav-link">Daftar Pemasok</a>
            <a href="" class="nav-item nav-link">Daftar Produk</a>
            &nbsp; &nbsp;<img class="img-fluid logo-navbar" src="../assets/img/logo.jpeg" alt="">
        </div>
</nav>
<!-- Navbar End -->

    <div class="container">
        <!-- Header -->
        <!-- Summary Cards -->
        <section class="summary">
            <div class="card"><strong>10</strong>Pesanan Menunggu Pengembalian</div>
            <div class="card"><strong>20</strong>Stok Produk</div>
            <div class="card"><strong>10</strong>Pengguna</div>
            <div class="card"><strong>20</strong>Pemasok</div>
        </section>
        <!-- Main Content -->
        <section class="content">
            <div class="reports">
            <section class="reports">
            <div class="reports-header">
        <h2>Grafik Penjualan</h2>
    </div>
    <div class="chart-container">
        <canvas id="reportChart"></canvas>
        <div class="menu">
        </div>
    </div>
        </section>
            </div>
            <div class="analytics">
                <h2>Analisis</h2>
            </div>
        </section>
        <!-- Recent Orders & Top Products -->
        <section class="orders">
            <div class="recent-orders">
                <h2>Pesanan Terbaru</h2>
                <table id="example" class="table table-striped">
                    <br><thead>
                    <tr>
                        <th>Nomor Invoice</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Total Pesanan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>#1005</td>
                        <td>iPhone 12</td>
                        <td>$987</td>
                        <td>850</td>
                        <td>450</td>
                    </tr>
                    </tbody>
                    <!-- Add more rows as needed -->
                </table>
            </div>
            <div class="product-container">
    <h2>Top Produk</h2>
    <div class="product-item">
      <img src="../assets/img/ban.jpeg" alt="NIKE Shoes Black Pattern">
      <div class="product-details">
        <h3>NIKE Shoes Black Pattern</h3>
        <div class="rating">
          <span></span>
        </div>
        <p class="price">$87</p>
      </div>
    </div>
    <div class="product-item">
      <img src="../assets/img/ban.jpeg" alt="iPhone 12">
      <div class="product-details">
        <h3>iPhone 12</h3>
        <div class="rating">
          <span></span>
        </div>
        <p class="price">$987</p>
      </div>
    </div>
  </div>
        </section>
    </div>

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="script.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
         // Initialize Chart.js
const ctx = document.getElementById('reportChart').getContext('2d');
const reportChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['10am', '11am', '12pm', '1pm', '2pm', '3pm', '4pm', '5pm', '6pm', '7pm'],
        datasets: [{
            label: 'Sales Data',
            data: [40, 60, 80, 70, 90, 50, 30, 60, 80, 100],
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 2,
            fill: true,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

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
    <script>

    </script>
</body>
</html>