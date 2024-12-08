<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Beranda</title>
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
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-light p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-home text-primary me-2"></small>
                    <small><a href="{{ route('home') }}" class="">Beranda</a></small>
                </div>
                @if (Route::has('login'))
                    @auth
                    <div class="h-100 d-inline-flex align-items-center py-3">
                        <small class="far fa-user text-primary me-2"></small>
                        <small> {{ Auth::user()->name }} </small>
                    </div>
                    @endauth
                @endif
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
                <a href="{{ route('home') }}" class="nav-item nav-link active">Beranda</a>
                <a href="{{ route('about') }}" class="nav-item nav-link">Tentang</a>
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


    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="../assets/img/bengkel1.jpeg" alt="Image">
                    <div class="carousel-caption d-flex align-items-center">
                        <div class="container">
                            <div class="row align-items-center justify-content-center justify-content-lg-start">
                                <div class="col-10 col-lg-7 text-center text-lg-start">
                                    <h6 class="text-white text-uppercase mb-3 animated slideInDown">Ban Panbres</h6>
                                    <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">Performa Kendaraan Anda, Prioritas Kami</h1>
                                    <a href="{{ route('products') }}" class="btn btn-primary py-3 px-5 animated slideInDown">Produk<i class="fa fa-arrow-right ms-3"></i></a>
                                </div>
                                <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                    <img class="img-fluid" src="../assets/img/bengkel-1.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="../assets/img/bengkel2.jpeg" alt="Image">
                    <div class="carousel-caption d-flex align-items-center">
                        <div class="container">
                            <div class="row align-items-center justify-content-center justify-content-lg-start">
                                <div class="col-10 col-lg-7 text-center text-lg-start">
                                    <h6 class="text-white text-uppercase mb-3 animated slideInDown">Ban Panbres</h6>
                                    <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">Dapatkan Layanan Ban Terpercaya di Sini!</h1>
                                    <a href="{{ route('products') }}" class="btn btn-primary py-3 px-5 animated slideInDown">Produk<i class="fa fa-arrow-right ms-3"></i></a>
                                </div>
                                <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                    <img class="img-fluid" src="../assets/img/bengkel-2.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="d-flex py-5 px-4">
                        <i class="fa fa-certificate fa-3x text-primary flex-shrink-0"></i>
                        <div class="ps-4">
                            <h5 class="mb-3">Servis Berkualitas</h5>
                            <p>
                                Servis berkualitas di bengkel ban kami menjamin keselamatan dan kenyamanan berkendara Anda
                                <span class="extraText" style="display: none;">
                                    <br><br>Di bengkel ban kami, kami berkomitmen untuk memberikan servis berkualitas tinggi yang memastikan keselamatan dan kenyamanan berkendara Anda
                                    <br><br>Tim teknisi kami terdiri dari tenaga ahli yang berpengalaman dan terlatih, menggunakan peralatan modern untuk memeriksa, memasang, dan merawat ban kendaraan Anda.
                                    Kami menawarkan berbagai jenis ban, mulai dari ban mobil vulkanisir, ban mobil pick up, dan sebagainya.
                                    Dengan pilihan ban dari merek-merek terpercaya, kami siap memberikan saran yang tepat sesuai kebutuhan dan anggaran Anda
                                </span>
                            </p>
                            <a class="read-more-link border-bottom" href="javascript:void(0);" onclick="toggleText(this)">Baca Selengkapnya</a>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="d-flex bg-light py-5 px-4">
                        <i class="fa fa-users-cog fa-3x text-primary flex-shrink-0"></i>
                        <div class="ps-4">
                            <h5 class="mb-3">Pekerja Berpengalaman</h5>
                            <p>
                                Pekerja berpengalaman di bengkel ban kami siap memberikan layanan terbaik dengan keahlian dan keterampilan yang teruji
                                <span class="extraText" style="display: none;">
                                    <br><br>Dengan bertahun-tahun pengalaman di industri ini, mereka mampu menangani berbagai jenis kendaraan dan masalah yang terkait dengan ban secara efisien dan efektif
                                    <br><br>Setiap teknisi kami dilatih secara profesional untuk memastikan pelayanan yang maksimal, memberikan saran yang tepat, serta memastikan keselamatan dan kenyamanan berkendara Anda.
                                    Kami percaya bahwa keahlian mereka adalah aset berharga yang menjamin kualitas layanan dan kepuasan pelanggan di setiap kunjungan
                                </span>
                            </p>
                            <a class="read-more-link border-bottom" href="javascript:void(0);" onclick="toggleText(this)">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="d-flex py-5 px-4">
                        <i class="fa fa-tools fa-3x text-primary flex-shrink-0"></i>
                        <div class="ps-4">
                            <h5 class="mb-3">Peralatan Lengkap</h5>
                            <p>
                                Bengkel ban kami dilengkapi dengan peralatan modern dan lengkap, memastikan semua layanan dilakukan dengan presisi dan efisiensi
                                <span class="extraText" style="display: none;">
                                    <br><br>Dari mesin pemasangan dan penyeimbangan ban yang canggih hingga alat diagnostik terkini, setiap peralatan kami memastikan bahwa layanan dilakukan dengan presisi dan efisiensi tinggi
                                    <br><br>Kami percaya bahwa penggunaan teknologi terbaik tidak hanya meningkatkan kualitas pekerjaan, tetapi juga membantu mempercepat proses, sehingga Anda dapat kembali berkendara dengan cepat dan aman.
                                    Dengan peralatan yang selalu terawat dan terbaru, kami siap memberikan pelayanan optimal untuk setiap jenis kendaraan
                                </span>
                            </p>
                            <a class="read-more-link border-bottom" href="javascript:void(0);" onclick="toggleText(this)">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- About Start -->
    <div id="about" class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 pt-4" style="min-height: 400px;">
                    <div class="position-relative h-100 wow fadeIn" data-wow-delay="0.1s">
                        <img class="position-absolute img-fluid w-100 h-100" src="../assets/img/about.jpeg" style="object-fit: cover;" alt="">
                        <div class="position-absolute top-0 end-0 mt-n4 me-n4 py-4 px-5" style="background: rgba(0, 0, 0, .08);">
                            <h1 class="text-primary display-4 mb-0">10+ <span class="text-primary fs-4">Tahun</span></h1>
                            <h4 class="text-primary">Pengalaman</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h6 class="text-primary text-uppercase">Tentang Kami</h6>
                    <h1 class="mb-4"><span class="text-primary">Panbres,</span> Layanan Terbaik untuk Ban Anda</h1>
                    <p class="mb-4">Panbres adalah solusi tepat untuk semua kebutuhan ban kendaraan Anda, menawarkan layanan berkualitas tinggi yang didukung oleh teknisi berpengalaman dan peralatan modern.
                                    Kami berkomitmen untuk memberikan pelayanan yang cepat, efisien, dan ramah, menjamin keselamatan serta kenyamanan setiap pelanggan yang datang ke bengkel kami</p>
                    <div class="row g-4 mb-3 pb-3">
                        <div class="col-12 wow fadeIn" data-wow-delay="0.1s">
                            <div class="d-flex">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-secondary">01</span>
                                </div>
                                <div class="ps-3">
                                    <h6>Teknisi Berpengalaman</h6>
                                    <span>Tim kami terdiri dari ahli yang terlatih, siap menangani beragam masalah ban dengan keahlian tinggi</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                            <div class="d-flex">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-secondary">02</span>
                                </div>
                                <div class="ps-3">
                                    <h6>Peralatan Modern</h6>
                                    <span>Kami menggunakan teknologi terbaru untuk memastikan setiap layanan dilakukan dengan presisi dan efisiensi maksimal</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                            <div class="d-flex">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-secondary">03</span>
                                </div>
                                <div class="ps-3">
                                    <h6>Pelayanan Cepat & Ramah</h6>
                                    <span>Kami mengutamakan kepuasan pelanggan dengan proses yang cepat dan interaksi yang bersahabat</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('about') }}" class="btn btn-primary py-3 px-5">Baca Selengkapnya<i class="fa fa-arrow-right ms-3"></i></a>
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
    
    <script>
        function toggleText(link) {
            const extraText = link.previousElementSibling.querySelector(".extraText");
            if (extraText.style.display === "none") {
                extraText.style.display = "inline";
                link.textContent = "Baca Lebih Sedikit";
            } else {
                extraText.style.display = "none";
                link.textContent = "Baca Selengkapnya";
            }
        }
    </script>
</body>

</html>