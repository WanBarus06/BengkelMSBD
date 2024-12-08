<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tentang</title>
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
    <link href="../assets/css/about.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-light p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-info-circle text-primary me-2"></small>
                    <small><a href="{{ route('about') }}" class="">Tentang</a></small>
                </div>
                @if (Route::has('login'))
                    @auth
                    <div class="h-100 d-inline-flex align-items-center py-3">
                        <small class="far fa-user text-primary me-2"></small>
                        <small> {{ Auth::user()->name }} </small>
                    </div>
                    @endauth
                @endif
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
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
                <a href="{{ route('about') }}" class="nav-item nav-link active">Tentang</a>
                <a href="{{ route('products') }}" class="nav-item nav-link">Produk</a>
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
                    <img class="img-fluid logo-navbar" src="../assets/img/logo.jpeg" alt="">
                    
                @else
                <a href="{{ route('login') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Daftar / Masuk<i class="fa fa-arrow-right ms-3"></i></a>
                    @endauth
                @endif
                
            </div>

        </div>
    </nav>
    <!-- Navbar End -->

    <!-- About Start -->
    <div id="about" class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Bagian Gambar -->
            <div class="col-lg-6 pt-4" style="min-height: 400px;">
                <div class="position-relative h-100 wow fadeIn" data-wow-delay="0.1s">
                    <img class="position-absolute img-fluid w-100 h-100" src="../assets/img/about.jpeg" style="object-fit: cover;" alt="Tentang Panbres">
                    <div class="position-absolute top-0 end-0 mt-n4 me-n4 py-4 px-5" style="background: rgba(0, 0, 0, .08);">
                        <h1 class="text-primary display-4 mb-0">10+ <span class="text-primary fs-4">Tahun</span></h1>
                        <h4 class="text-primary">Pengalaman</h4>
                    </div>
                </div>
            </div>
            <!-- Bagian Teks -->
            <div class="col-lg-6">
                <h6 class="text-primary text-uppercase">Tentang Kami</h6>
                <h1 class="mb-4"><span class="text-primary">Panbres,</span>, Solusi Menyeluruh untuk Kendaraan Anda</h1>
                <p class="mb-4">
                    Panbres adalah layanan profesional yang didedikasikan untuk memberikan solusi terbaik bagi kebutuhan ban dan kendaraan Anda. Dengan lebih dari 10 tahun pengalaman di industri otomotif, kami memahami betapa pentingnya keselamatan, kenyamanan, dan keandalan saat berkendara. Oleh karena itu, kami hadir dengan berbagai layanan berkualitas tinggi yang dirancang untuk memenuhi kebutuhan setiap pelanggan, baik individu maupun perusahaan.
                </p>
                <p class="mb-4">
                    Kami tidak hanya memberikan layanan, tetapi juga berkomitmen untuk menciptakan hubungan jangka panjang dengan pelanggan melalui pendekatan yang ramah dan profesional. Filosofi kami adalah memberikan lebih dari sekadar perbaikan teknis—kami ingin memastikan setiap pelanggan meninggalkan bengkel kami dengan rasa puas dan percaya diri.
                </p>
                <!-- Fitur Unggulan -->
                <div class="row g-4 mb-3 pb-3">
                    <!-- Fitur 1 -->
                    <div class="col-12 wow fadeIn" data-wow-delay="0.1s">
                        <div class="d-flex">
                            <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                <span class="fw-bold text-secondary">01</span>
                            </div>
                            <div class="ps-3">
                                <h6>Teknisi Berpengalaman</h6>
                                <span>
                                    Dengan tim teknisi bersertifikasi dan berpengalaman, kami mampu menangani segala jenis masalah kendaraan, mulai dari perbaikan ban hingga perawatan berkala. Kami memastikan kendaraan Anda berada di tangan yang tepat.
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Fitur 2 -->
                    <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                        <div class="d-flex">
                            <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                <span class="fw-bold text-secondary">02</span>
                            </div>
                            <div class="ps-3">
                                <h6>Peralatan Modern</h6>
                                <span>
                                    Kami percaya bahwa teknologi adalah kunci untuk hasil terbaik. Oleh karena itu, kami menggunakan peralatan modern dan teknologi terkini untuk memastikan setiap pekerjaan dilakukan dengan presisi tinggi.
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Fitur 3 -->
                    <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                        <div class="d-flex">
                            <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                <span class="fw-bold text-secondary">03</span>
                            </div>
                            <div class="ps-3">
                                <h6>Pelayanan Cepat & Ramah</h6>
                                <span>
                                    Waktu Anda adalah prioritas kami. Dengan tim yang terlatih dan sistem kerja yang efisien, kami memastikan proses perbaikan berlangsung cepat tanpa mengorbankan kualitas, sambil tetap memberikan pelayanan ramah.
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tambahan Konten -->
                <p>
                    Kami tidak hanya memberikan perbaikan teknis, tetapi juga memberikan edukasi kepada pelanggan tentang cara merawat ban dan kendaraan mereka dengan baik. Dengan cara ini, kami tidak hanya menjadi penyedia layanan, tetapi juga mitra tepercaya bagi Anda dalam perjalanan panjang Anda di jalan raya.
                </p>
                <p>
                    Jadi, tunggu apa lagi? Datang dan buktikan sendiri mengapa Panbres menjadi pilihan utama untuk perawatan kendaraan. Keselamatan, kenyamanan, dan kepuasan Anda adalah misi utama kami.
                </p>
            </div>
        </div>
    </div>
</div>
    <!-- About End -->

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

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../assets/js/main.js"></script>
</body>

</html>