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

@media pdf {
    table {
        border-collapse: collapse;
        width: 100%;
    }

    table th, table td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    tfoot th[colspan="5"] {
        text-align: right; /* Agar tulisan total kesemua penjualan rata kanan */
        font-weight: bold;
    }

    table thead th {
        background-color: #f2f2f2; /* Warna latar header */
    }

    body {
        margin: 0;
        padding: 0;
    }
}

tfoot th {
    text-align: right; /* Rata kanan */
    font-weight: bold;
    border-top: 2px solid #000; /* Garis atas untuk pemisah */
}

tfoot th[colspan="6"] {
    text-align: right; /* Rata kanan */
    font-weight: bold;
}
    </style>

</head>
<body>

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
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('dashboard-owner') }}" class="nav-item nav-link active">Beranda</a>
                <a href="{{ route('user-list') }}" class="nav-item nav-link">Daftar Pengguna</a>
                <a href="{{ route('staff-list') }}" class="nav-item nav-link">Daftar Pegawai</a>
                <a href="{{ route('product-list') }}" class="nav-item nav-link">Daftar Produk</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->
    
    <!-- Product Detail Start -->
    <div class="container mt-5">
        <h3 class="text-center mb-4">Detail Produk</h3>
        <form method="POST" action="{{ route('product-update', $product->product_id) }}">
            @csrf
            @method('PUT')
    
            <div class="row g-3">
                <!-- Nama Produk -->
                <div class="col-md-6">
                    <label for="product_name" class="form-label">Nama Produk</label>
                    <input type="text" id="product_name" name="product_name" class="form-control" value="{{ $product->product_name }}">
                </div>
    
                <!-- Status Produk -->
                <div class="col-md-6">
                    <label for="is_active" class="form-label">Status</label>
                    <input type="text" id="is_active" name="is_active" class="form-control" value="{{ $product->is_active ? 'Aktif' : 'Non-aktif' }}" readonly>
                </div>
            </div>
            <div class="row g-3 mt-3">
                <!-- Stok Produk -->
                <div class="col-md-6">
                    <label for="stock" class="form-label">Stok</label>
                    <input type="text" id="stock" name="stock" class="form-control" value="{{ $product->productDetail->stock }}">
                </div>
    
                <!-- Harga -->
                <div class="col-md-6">
                    <label for="price" class="form-label">Harga</label>
                    <input type="number" id="price" name="product_sell_price" class="form-control" value="{{ $product->productDetail->product_sell_price }}">
                </div>
            </div>
            <div class="row g-3 mt-3">
                <!-- Deskripsi -->
                <div class="col-md-6">
                    <label for="product_description" class="form-label">Deskripsi</label>
                   <input type ="text" id="oroduct_description" name="product_description" class="form-control" value="{{ $product->productDescription->product_description }}">
                </div>
    
                <!-- Brand -->
                <div class="col-md-6">
                    <label for="brand" class="form-label">Brand</label>
                    <select id="brand" name="brand_id" class="form-select">
                        @foreach($brands as $brand)
                            <option value="{{ $brand->brand_id }}" 
                                {{ $brand->brand_id == $product->productDescription->brand_id ? 'selected' : '' }}>
                                {{ $brand->brand_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>          
    
            <div class="row g-3 mt-3">
                <!-- Ukuran -->
                <div class="col-md-6">
                    <label for="size" class="form-label">Ukuran</label>
                    <select id="size" name="size_id" class="form-select">
                        @foreach($sizes as $size)
                            <option value="{{ $size->size_id }}" 
                                {{ $size->size_id == $product->productDescription->size_id ? 'selected' : '' }}>
                                {{ $size->size_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
    
                <!-- Variasi -->
                <div class="col-md-6">
                    <label for="variant" class="form-label">Variasi</label>
                    <select id="variant" name="variant_id" class="form-select">
                        @foreach($variants as $variant)
                            <option value="{{ $variant->variant_id }}" 
                                {{ $variant->variant_id == $product->productDescription->variant_id ? 'selected' : '' }}>
                                {{ $variant->variant_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row g-3 mt-3">
                <!-- Ukuran -->
                <div class="col-md-6">
                    <label for="size" class="form-label">Stok Warning</label>
                    <input type="number" name="warning_stock" class="form-select" value="{{ $product->productDetail->warning_stock }}">
                </div>
    
                <!-- Variasi -->
                {{-- <div class="col-md-6">
                    <label for="variant" class="form-label">Variasi</label>
                    <input type="text" name>
                </div> --}}
            </div>
    
            <!-- Update Button -->
            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary">Update Produk</button>
            </div>
        </form>
    </div>
    <!-- Product Detail End -->
    
</body>
</html>