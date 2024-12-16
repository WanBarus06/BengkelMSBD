<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Produk</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../assets/img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="../assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/products.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
    .quantity-control {
        max-width: 150px; /* Limit the width for a balanced look */
    }

    .quantity-control .btn-danger {
        color: #FFFFFF;
        background-color: #D81324; /* Use the red color theme */
        border: none;
        border-radius: 0; /* Ensure no extra rounding */
        width: 40px; /* Set button width for uniformity */
        height: 40px; /* Set button height for alignment */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .quantity-control input {
        width: 50px;
        font-weight: 600;
        height: 40px; /* Match input height to buttons */
        border: none;
        box-shadow: none;
    }

    .quantity-control input:focus {
        outline: none; /* Remove blue focus outline */
        box-shadow: none; /* Remove shadow */
    }

    .card {
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .card-body {
        flex: 1 1 auto;
    }
</style>
</head>
<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-light p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                <small class="fas fa-shopping-cart text-primary me-2"></small>
                <small><a href="{{ route('products') }}" class="">Produk</a></small>
                </div>
                @if (Route::has('login'))
                    @auth
                    <div class="h-100 d-inline-flex align-items-center py-3">
                        <small class="far fa-user text-primary me-2"></small>
                        <small> {{ Auth::user()->name }} </small>
                    </div>
                    @endauth
                @endif
                <div class="h-100 d-inline-flex align-items-center py-3">
                <small></small>
                <small></small>
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
                <a href="{{ route('home') }}" class="nav-item nav-link">Beranda</a>
                <a href="{{ route('about') }}" class="nav-item nav-link">Tentang</a>
                <a href="{{ route('products') }}" class="nav-item nav-link active">Produk</a>
                <a href="http://wa.me/6281375506448" class="nav-item nav-link">Kontak</a>
                @if (Route::has('login'))
                    @auth
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Profil</a>
                        <div class="dropdown-menu fade-up m-0">
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">Pengaturan</a>
                            <a href="{{ route('transaction') }}" class="dropdown-item">Riwayat Transaksi</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Keluar</button>
                            </form>
                        </div>
                    </div>
                    <a href="{{ route('cart.index') }}" class="nav-item nav-link"><i class="fas fa-shopping-bag fa-lg"></i></a>

                @else
                <a href="{{ route('login') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Daftar / Masuk<i class="fa fa-arrow-right ms-3"></i></a>
                    @endauth
                @endif
                
            </div>

        </div>
    </nav>
    <!-- Navbar End -->

<!-- Filter and Search Section Start -->
<!-- Main Container -->
<div class="container-fluid mt-5">
    <div class="row">
        <!-- Sidebar Filter -->
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="filter-bar">
                <h5 class="m-0 text-primary"><i class="fa fa-filter me-3"></i>Filter</h5>
                <!-- Sort Options -->
                <div class="filter-section mb-4">
                    <ul class="list-unstyled bg-light p-2 rounded">
                        <li><a href="?sort=popular">Popular</a></li>
                        <li><a href="?sort=name_asc">Nama A - Z</a></li>
                        <li><a href="?sort=name_desc">Nama Z - A</a></li>
                        <li><a href="?sort=price_low_high">Harga Rendah - Tinggi</a></li>
                        <li><a href="?sort=price_high_low">Harga Tinggi - Rendah</a></li>
                        <li><a href="?sort=clear">Hapus Sortiran</a></li>
                    </ul>
                </div>
                <!-- Category Filter -->
                <div class="filter-section mb-3">
                    <h6>Kategori <span class="float-end">+</span></h6>
                    <ul class="list-unstyled">
                        @foreach ($variants as $variant)
                            <li>
                                <a href="?category={{ $variant->variant_id }}">{{ $variant->variant_name }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <hr>
                </div>
                <!-- Price Filter -->
                <div class="filter-section mb-4">
                    <h6>Harga</h6>
                    <form action="{{ route('products') }}" method="GET">
                        <div class="mb-2">
                            <input type="number" name="price_min" class="form-control" placeholder="Harga Minimum">
                        </div>
                        <div class="mb-2">
                            <input type="number" name="price_max" class="form-control" placeholder="Harga Maksimum">
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Cari</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Product Listing -->
        <div class="col-lg-9 col-md-8">
            <!-- Search Bar -->
            <div class="search-bar d-flex justify-content-between align-items-center mb-4">
                <form action="{{ route('products') }}" method="GET" class="d-flex w-100">
                    <input type="text" name="search" class="form-control" placeholder="Cari produk...">
                    <button type="submit" class="btn btn-primary ms-2">Cari</button>
                </form>
            </div>

            <!-- Product Variants -->
            @foreach ($groupedByVariant as $variantName => $products)
                <div class="variant-section mb-5">
                    <h2 class="text-primary">{{ $variantName }}</h2>
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                <div class="card h-100">
                                    <img src="../assets/img/ban.jpeg" class="card-img-top" alt="Product Image">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $product->product_name }}</h6>
                                        <p class="card-text">Harga: Rp {{ number_format($product->productDetail->product_sell_price) }}</p>
                                        <p class="card-text">Stok: {{ $product->productDetail->stock }}</p>
                                        <form action="{{ route('cart.store', $product->product_id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary w-100">Tambah ke Keranjang</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5 justify-content-center">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Alamat</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Jalan H. Anif No.361 Rt 02 Jati Asri Susun XXIV Desa Sampali, Kec. Percut Sei Tuan, Kab. Deli Serdang</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+62 813 7550 6448</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Jam Operasional</h4>
                    <h6 class="text-light">Senin - Sabtu :</h6>
                    <p class="mb-4">08.30 - 19.00</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Kategori</h4>
                    <a class="btn btn-link" href="">Ban Radial</a>
                    <a class="btn btn-link" href="">Ban Nilon</a>
                    <a class="btn btn-link" href="">Ban Semi Radial</a>
                    <a class="btn btn-link" href="">Ban Mati (Solid Tire)</a>
                    <a class="btn btn-link" href="">Ban Vulkanisir</a>
                    <a class="btn btn-link" href="">Karet ban (Tube Flap)</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-center mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="">Ban Panbres (Panjaitan Bersaudara)</a>
                    </div>
                    <div class="col-md-6 text-center text-md-center">
                        <div class="footer-menu">
                            <a href="http://wa.me/6281375506448">Bantuan</a>
                            <a href="">SSD</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Footer End -->

<!-- Tombol Filter Responsif -->
<a href="#filter-section" class="btn btn-lg btn-primary btn-lg-square filter-toggle d-lg-none">
    <i class="fa fa-filter me-0"></i>
</a>

</body>
</html>