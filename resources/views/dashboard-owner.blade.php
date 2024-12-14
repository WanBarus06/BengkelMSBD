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

    <style>
    .dataTables_wrapper .top {
        align-items: center; /* Pastikan tombol dan search sejajar */
        gap: 50px; /* Memberikan jarak antar elemen */
    }

    .dataTables_wrapper .dataTables_filter {
        margin-left: auto; /* Posisikan search box ke kanan */
    }

    .dataTables_wrapper .dt-buttons {
        margin-right: auto; /* Posisikan tombol ke kiri */
    }

    .dataTables_wrapper .bottom {
    display: flex; /* Aktifkan Flexbox */
    justify-content: space-between; /* Elemen berjauhan ujung ke ujung */
    align-items: center; /* Elemen sejajar vertikal */
    padding: 10px 0; /* Tambahkan jarak atas/bawah */
}

.dataTables_wrapper .dataTables_length {
    margin-bottom: 0; /* Hilangkan margin bawah bawaan */
}

.dataTables_wrapper .dataTables_paginate {
    margin-bottom: 0; /* Hilangkan margin bawah bawaan */
}

.dataTables_paginate {
    display: flex; /* Membuat tombol tampil sejajar */
    justify-content: center; /* Menempatkan di tengah */
    gap: 10px; /* Jarak antar tombol */
}

.dataTables_paginate .paginate_button {
    margin: 0 5px; /* Tambahkan margin horizontal antar tombol */
    padding: 5px 10px; /* Sesuaikan padding untuk tampilan yang lebih rapi */
    border: 1px solid #ccc; /* Tambahkan border jika diperlukan */
    border-radius: 5px; /* Membuat sudut tombol lebih halus */
    color: #333; /* Warna teks */
    background-color: #fff; /* Warna latar belakang */
    cursor: pointer;
    text-decoration: none; /* Hilangkan garis bawah */
}

.dataTables_paginate .paginate_button:hover {
    background-color: #f0f0f0; /* Efek hover */
    border-color: #aaa;
}

.dataTables_paginate .paginate_button.current {
    background-color: #007bff; /* Warna tombol aktif */
    color: #fff;
    border-color: #007bff;
}

/* Responsif untuk layar kecil */
@media (max-width: 768px) {
    .dataTables_wrapper .bottom {
        flex-direction: column; /* Elemen vertikal pada layar kecil */
        gap: 10px; /* Tambahkan jarak antar elemen */
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
            <a href="{{ route('dashboard-owner') }}" class="nav-item nav-link active">Beranda</a>
            <a href="{{ route('user-list') }}" class="nav-item nav-link">Daftar Pengguna</a>
            <a href="{{ route('staff-list') }}" class="nav-item nav-link">Daftar Pegawai</a>
            <a href="{{ route('product-list') }}" class="nav-item nav-link">Daftar Produk</a>
            &nbsp; &nbsp;<img class="img-fluid logo-navbar" src="../assets/img/logo.jpeg" alt="">
        </div>
</nav>
<!-- Navbar End -->

    <div class="container">
        <!-- Header -->
        <!-- Summary Cards -->
<section class="summary">
<div class="card">
    <strong class="pengguna">Loading...</strong>
</div>
<div class="card">
    <strong class="pegawai">Loading...</strong>
</div>
<div class="card">
    <strong class="produk">Loading...</strong>
</div>
</section>
        <!-- Main Content -->

        <!-- Grafik Penjualan -->
        <section class="reports mb-5">
            <h2 class="text-center">Grafik Penjualan</h2>
            <canvas id="reportChart"></canvas>
        </section>

        <!-- Laporan Penjualan -->
        <section class="analytics mb-5">
            <h2 class="text-center">Laporan Penjualan</h2>
            <!-- Tabel Data -->
            <table id="laporanPenjualan" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nomor Invoice</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Total Qty</th>
                        <th>Total Pesanan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataPenjualan as $penjualan)
                    <tr>
                        <td>{{ $penjualan->invoice }}</td>
                        <td>{{ $penjualan->nama_produk }}</td>
                        <td>{{ number_format($penjualan->harga, 2) }}</td>
                        <td>{{ $penjualan->total_qty }}</td>
                        <td>{{ number_format($penjualan->total_pesanan, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section class="analytics mb-5">
            <h2 class="text-center">Pesanan Terbaru</h2>
            <!-- Tabel Data -->
            <table id="pesananTerbaru" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nomor Invoice</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Total Qty</th>
                        <th>Total Pesanan</th>
                        <th>Detail Pesanan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataPenjualan as $penjualan)
                    <tr>
                        <td>{{ $penjualan->invoice }}</td>
                        <td>{{ $penjualan->nama_produk }}</td>
                        <td>{{ number_format($penjualan->harga, 2) }}</td>
                        <td>{{ $penjualan->total_qty }}</td>
                        <td>{{ number_format($penjualan->total_pesanan, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

<section class="top-products mb-5">
    <!-- Top Produk -->
    <div class="col-lg-6 mb-4">
        <h2 class="text-center">Top Produk</h2>
        <div class="product-container">
            <div class="product-item">
                <img src="../assets/img/ban.jpeg" alt="NIKE Shoes" style="width: 80px; margin-right: 15px;">
                <div>
                    <h5>NIKE Shoes Black Pattern</h5>
                    <p class="price mb-0">$87</p>
                </div>
            </div>
            <div class="product-item">
                <img src="../assets/img/ban.jpeg" alt="iPhone 12" style="width: 80px; margin-right: 15px;">
                <div>
                    <h5>iPhone 12</h5>
                    <p class="price mb-0">$987</p>
                </div>
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
    // Ambil data penjualan dari server-side Laravel
    const penjualanData = @json($penjualanHarian);

    // Ubah data menjadi array untuk grafik
    const labels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    const dataValues = labels.map(day => penjualanData[day] || 0);

    // Inisialisasi Chart.js
    const ctx = document.getElementById('reportChart').getContext('2d');
    const reportChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Penjualan Harian',
                data: dataValues,
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
                    display: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    $(document).ready(function() {
        $.ajax({
            url: '/api/dashboard-data',
            method: 'GET',
            success: function(data) {
                $('.pengguna').text(data.jumlahPengguna + ' Pengguna Aktif');
                $('.pegawai').text(data.jumlahPegawai + ' Pegawai Aktif');
                $('.produk').text(data.jumlahProduk + ' Produk Tersedia');                
            },
            error: function(err) {
                console.error("Gagal memuat data", err);
            }
        });
    });

    $('#laporanPenjualan').DataTable({
    dom: '<"top d-flex justify-content-between"Bfr>t<"bottom d-flex justify-content-between"lp><"clear">',
    buttons: ['copy', 'excel', 'print'],
    searching: true,
    info: true,
    language: {
        lengthMenu: "Tampilkan &nbsp _MENU_ &nbsp data per halaman",
        info: "Menampilkan _START_ data sampai _END_ dari _TOTAL_ data",
        paginate: {
            next: "Selanjutnya",
            previous: "Sebelumnya",
        },
        search: "Cari : &nbsp",
    }
});

    $('#pesananTerbaru').DataTable({
        dom: '<"top"Bfr>t<"bottom d-flex justify-content-between align-items-center"lp><"clear">',
        buttons: [],
        searching: true, // Mengaktifkan search box
        info: true,
        language: {
            lengthMenu: "Tampilkan &nbsp _MENU_ &nbsp data per halaman",
            info: "Menampilkan _START_ data sampai _END_ dari _TOTAL_ data",
            paginate: {
                next: "Selanjutnya",
                previous: "Sebelumnya",
            },
            search: "Cari : &nbsp",
        }

});
    </script>
</body>
</html>