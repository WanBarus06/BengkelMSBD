<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Homepage</title>
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
                    <small>Home</small>
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
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="text-primary me-2"></small>
                    <small></small>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-car me-3"></i>Bengkel Panbres</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('home') }}" class="nav-item nav-link active">Home</a>
                <a href="#about" class="nav-item nav-link">About</a>
                <a href="{{ route('products') }}" class="nav-item nav-link">Products</a>
                <a href="http://wa.me/6281375506448" class="nav-item nav-link">Contact</a>
                @if (Route::has('login'))
                    @auth
                <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Profile</a>
                        <div class="dropdown-menu fade-up m-0">
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">Settings</a>
                            <a href="{{ route('transaction') }}" class="dropdown-item">Transaction History</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Log Out</button>
                            </form>
                        </div>
                    </div>
                        <a href="contact.html" class="nav-item nav-link">Logo</a>
                @else
                <a href="{{ route('login') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Register / Login<i class="fa fa-arrow-right ms-3"></i></a>
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
                                    <a href="" class="btn btn-primary py-3 px-5 animated slideInDown">Products<i class="fa fa-arrow-right ms-3"></i></a>
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
                                    <a href="" class="btn btn-primary py-3 px-5 animated slideInDown">Products<i class="fa fa-arrow-right ms-3"></i></a>
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
                            <a class="read-more-link border-bottom" href="javascript:void(0);" onclick="toggleText(this)">Read More</a>
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
                            <a class="read-more-link border-bottom" href="javascript:void(0);" onclick="toggleText(this)">Read More</a>
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
                            <a class="read-more-link border-bottom" href="javascript:void(0);" onclick="toggleText(this)">Read More</a>
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
                            <h1 class="text-primary display-4 mb-0">15 <span class="text-primary fs-4">Years</span></h1>
                            <h4 class="text-primary">Experience</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h6 class="text-primary text-uppercase">About Us</h6>
                    <h1 class="mb-4"><span class="text-primary">Panbres</span>, Layanan Terbaik untuk Ban Anda</h1>
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
                    <a href="" class="btn btn-primary py-3 px-5">Read More<i class="fa fa-arrow-right ms-3"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Fact Start -->

    <!-- Fact End -->


    <!-- Service Start -->
    
    <!-- Service End -->


    <!-- Booking Start -->
    <div class="container-fluid bg-secondary booking my-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-6 py-5">
                    <div class="py-5">
                        <h1 class="text-white mb-4">Bengkel Ban Pilihan Anda</h1>
                        <p class="text-white mb-0">
                            Bengkel ban kami adalah penyedia layanan perawatan dan perbaikan ban yang terpercaya merupakan pilihan banyak orang atas kualitas layanan yang kami berikan.
                            Dengan tim teknisi berpengalaman dan peralatan modern, kami berkomitmen untuk memastikan keselamatan dan kenyamanan kendaraan Anda.
                            Pelayanan kami yang cepat dan efisien, serta fokus pada kebutuhan pelanggan, menjadikan kami pilihan utama bagi pemilik kendaraan yang mengutamakan kualitas dan keandalan
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="bg-primary h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn" data-wow-delay="0.6s">
                        <h1 class="text-white mb-4">FORM PEMESANAN</h1>
                        <form>
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control border-0" placeholder="Nama Anda" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" class="form-control border-0" placeholder="No HP/WA Anda" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select class="form-select border-0" style="height: 55px;">
                                        <option selected>Pilih Kategori</option>
                                        <option value="1">Ban Vulkanisir</option>
                                        <option value="2">Ban Biasa</option>
                                        <option value="3">Karet Ban</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="date" id="date1" data-target-input="nearest">
                                        <input type="text"
                                            class="form-control border-0 datetimepicker-input"
                                            placeholder="Tanggal Pemesanan" data-target="#date1" data-toggle="datetimepicker" style="height: 55px;">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control border-0" placeholder="Pesan Tambahan"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-secondary w-100 py-3" type="submit">Pesan Sekarang</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Booking End -->


    <!-- Team Start -->
    
    <!-- Team End -->


    <!-- Testimonial Start -->
    
    <!-- Testimonial End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
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
                    <a class="btn btn-link" href="">Ban Vulkanisir</a>
                    <a class="btn btn-link" href="">Ban Biasa</a>
                    <a class="btn btn-link" href="">Karet Ban</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Kirim Pendapat Anda</h4>
                    <p>Kepuasan pelanggan adalah kepuasan kami!</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Ban Panbres (Panjaitan Bersaudara)</a>, All Right Reserved.

                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FAQs</a>
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
                link.textContent = "Read Less";
            } else {
                extraText.style.display = "none";
                link.textContent = "Read More";
            }
        }
    </script>
</body>

</html>