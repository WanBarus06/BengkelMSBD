<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Products</title>
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
    <div class="row gx-0 d-none d-lg-flex align-items-center">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                <small class="fa fa-home text-primary me-2"></small>
                <small>Home</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center py-3">
                <small class="fas fa-shopping-cart text-primary me-2"></small>
                <small>Products</small>
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
            <a href="contact.html" class="nav-item nav-link">Notifications</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Profile</a>
                <div class="dropdown-menu fade-up m-0">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">Settings</a>
                    <a href="{{ route('transaction') }}" class="dropdown-item">Transaction History</a>
                    <a href="" class="dropdown-item">Log Out</a>
                </div>
                </div>
                <a href="{{ route('cart') }}" class="nav-item nav-link"><i class="fas fa-shopping-bag fa-lg"></i></a>
        </div>
</nav>
<!-- Navbar End -->

<!-- Filter and Search Section Start -->
<div class="container-fluid mt-5">
    <div class="row">
        <!-- Sidebar Filter -->
        <div class="col-lg-3 col-md-4 mb-4">
        <div class="filter-bar">
    <h5 class="m-0 text-primary"><i class="fa fa-filter me-3"></i> Filter</h5>
    <div class="filter-section mb-4">
        <ul class="list-unstyled bg-light p-2 rounded">
            <li>Popular</li>
            <li>Nama A - Z</li>
            <li>Nama Z - A</li>
            <li>Harga Rendah - Tinggi</li>
            <li>Harga Tinggi - Rendah</li>
            <li>Hapus Filter</li>
        </ul>
    </div>

    <div class="filter-section mb-3">
        <h6>Kategori <span class="float-end">+</span></h6>
        <hr>
    </div>

    <div class="filter-section mb-4">
        <h6>Harga</h6>
        <div class="price-range">
            <div class="mb-2">
                <input type="text" class="form-control" placeholder="Rp Harga Minimum">
            </div>
            <div>
                <input type="text" class="form-control" placeholder="Rp Harga Maksimum">
            </div>
        </div>
    </div>

    <button class="btn btn-warning w-100">Cari</button>
</div>
        </div>

        <!-- Product and Search Section -->
        <div class="col-lg-9 col-md-8">
            <!-- Search Bar -->
            <div class="search-bar d-flex justify-content-between align-items-center mb-4">
                <h2 class="m-0 text-primary">
                    <i class="fas fa-search me-2"></i>
                    <input type="text" class="form-control d-inline w-75" placeholder="Cari produk..." aria-label="Search">
                </h2>
            </div>

            <!-- Products Start -->
            <div class="row d-flex align-items-stretch">
                <!-- Product Card Example -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card h-100">
                        <img src="../assets/img/ban.jpeg" class="card-img-top" width="100%">
                        <div class="card-body pt-0 px-0">
                            <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                <small class="text-muted mt-1">JENIS</small>
                                <h6 class="text-primary">1000 – 20 16PR MILLER RFD</h6>
                            </div>
                            <hr class="mt-2 mx-3">
                            <div class="d-flex flex-row justify-content-between px-3 pb-4">
                                <div class="d-flex flex-column">
                                    <span class="text-muted">Harga</span>
                                </div>
                                <div class="d-flex flex-column">
                                    <h5 class="mb-0 text-primary">Rp3,215,000</h5>
                                </div>
                            </div>
                            <div class="container-fluid d-flex justify-content-center py-3">
                                <div class="quantity-control d-flex align-items-center">
                                    <button type="button" class="btn btn-danger btn-sm px-3 fw-medium decrement">-</button>
                                    <input type="text" class="form-control text-center mx-2 quantity" value="1" readonly>
                                    <button type="button" class="btn btn-danger btn-sm px-3 fw-medium increment">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card h-100">
                        <img src="../assets/img/ban.jpeg" class="card-img-top" width="100%">
                        <div class="card-body pt-0 px-0">
                            <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                <small class="text-muted mt-1">JENIS</small>
                                <h6 class="text-primary">1000 – 20 16PR MILLER RFD</h6>
                            </div>
                            <hr class="mt-2 mx-3">
                            <div class="d-flex flex-row justify-content-between px-3 pb-4">
                                <div class="d-flex flex-column">
                                    <span class="text-muted">Harga</span>
                                </div>
                                <div class="d-flex flex-column">
                                    <h5 class="mb-0 text-primary">Rp3.215.000</h5>
                                </div>
                            </div>
                            <div class="container-fluid d-flex justify-content-center py-3">
                                <div class="quantity-control d-flex align-items-center">
                                    <button type="button" class="btn btn-danger btn-sm px-3 fw-medium decrement">-</button>
                                    <input type="text" class="form-control text-center mx-2 quantity" value="1" readonly>
                                    <button type="button" class="btn btn-danger btn-sm px-3 fw-medium increment">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card h-100">
                        <img src="../assets/img/ban.jpeg" class="card-img-top" width="100%">
                        <div class="card-body pt-0 px-0">
                            <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                <small class="text-muted mt-1">JENIS</small>
                                <h6 class="text-primary">1000 – 20 16PR MILLER RFD</h6>
                            </div>
                            <hr class="mt-2 mx-3">
                            <div class="d-flex flex-row justify-content-between px-3 pb-4">
                                <div class="d-flex flex-column">
                                    <span class="text-muted">Harga</span>
                                </div>
                                <div class="d-flex flex-column">
                                    <h5 class="mb-0 text-primary">Rp3.215.000</h5>
                                </div>
                            </div>
                            <div class="container-fluid d-flex justify-content-center py-3">
                                <div class="quantity-control d-flex align-items-center">
                                    <button type="button" class="btn btn-danger btn-sm px-3 fw-medium decrement">-</button>
                                    <input type="text" class="form-control text-center mx-2 quantity" value="1" readonly>
                                    <button type="button" class="btn btn-danger btn-sm px-3 fw-medium increment">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Products End -->
        </div>
    </div>
</div>

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

<!-- Tombol Filter Responsif -->
<a href="#filter-section" class="btn btn-lg btn-primary btn-lg-square filter-toggle d-lg-none">
    <i class="fa fa-filter me-0"></i>
</a>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Select all quantity-control divs
    document.querySelectorAll('.quantity-control').forEach((control) => {
        // Get the quantity input within the current control
        const quantityInput = control.querySelector('.quantity');

        // Add click event to decrement button
        control.querySelector('.decrement').addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        // Add click event to increment button
        control.querySelector('.increment').addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
        });
    });
});

    document.querySelector('.filter-toggle').addEventListener('click', function () {
        const filterBar = document.querySelector('.filter-bar');
        filterBar.classList.toggle('open');
    });

    // Untuk menutup filter dengan klik di luar sidebar
    document.addEventListener('click', function (event) {
        const filterBar = document.querySelector('.filter-bar');
        const toggleButton = document.querySelector('.filter-toggle');

        if (!filterBar.contains(event.target) && !toggleButton.contains(event.target)) {
            filterBar.classList.remove('open');
        }
    });

</script>

</body>
</html>