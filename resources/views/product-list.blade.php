<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Daftar Produk</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <link href="../assets/css/product-list.css" rel="stylesheet">

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
                    <small class="fas fa-clipboard-list text-primary me-2"></small>
                    <small><a href="{{ route('staff-list') }}" class="">Daftar Produk</a></small>
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
                <a href="{{ route('user-list') }}" class="nav-item nav-link">Daftar Pengguna</a>
                <a href="{{ route('staff-list') }}" class="nav-item nav-link">Daftar Pegawai</a>
                <a href="{{ route('product-list') }}" class="nav-item nav-link active">Daftar Produk</a>
                &nbsp; &nbsp;<img class="img-fluid logo-navbar" src="../assets/img/logo.jpeg" alt="">
            </div>
    </nav>
    <!-- Navbar End -->

    <div class="container">

        <!-- Tabel Data -->
        <br><br><div class="table-responsive">
        <div class="container">

        <!-- Tombol untuk membuka modal -->
  <a href="{{ route('add.product') }}" class="btn btn-primary">TAMBAH PRODUK</a> 

            <h1>Daftar Produk</h1>
            <table id="example" class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Stok</th>
            <th>Status</th>
            <th>Detail</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->product_id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->productDetail->stock }}</td>
                <td>{{ $product->is_active ? 'Aktif' : "Non-aktif" }}</td>
                <td>
                    <form action="{{ route('owner-product.show', ['id' => $product->product_id]) }}" method="GET">
                        <button type="submit" class="btn btn-sm btn-primary">
                            Lihat Detail
                        </button>
                    </form>
                </td>
                <td>
                    {{-- <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" 
                    data-id="{{ $product->product_id }}" data-nama="{{ $product->product_name }}" data-stok="{{ $product->productDetail->stock }}" data-status="{{ $product->is_active ? 'Aktif' : 'Non-aktif' }}">
                        Edit
                    </button> --}}
                    @if ($product->is_active)
                    <form action="{{ route('product.status', $product->product_id) }}" method="POST" id="deleteForm{{ $product->product_id }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-warning" onclick="confirmDelete({{ $product->product_id }})">Nonaktifkan</button>
                    </form>
                @else
                    <form action="{{ route('product.status', $product->product_id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Aktifkan</button>
                    </form>
                @endif  
            </tr>
        @endforeach
    </tbody>
</table>

</div>
    </div>

    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Detail Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 id="productName"></h5>
                <ul>
                    <li><strong>Harga : </strong> <span id="productHarga"></span></li>
                    <li><strong>Deskripsi : </strong> <span id="productDeskripsi"></span></li>
                    <li><strong>Brand : </strong> <span id="productBrand"></span></li>
                    <li><strong>Ukuran : </strong> <span id="productUkuran"></span></li>
                    <li><strong>Varian :</strong> <span id="productVarian"></span></li>
                    
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="mb-3">
                            <label for="editNama" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="editNama" name="product_name">
                        </div>
                        <div class="mb-3">
                            <label for="editStok" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="editStok" name="stock">
                        </div>
                        <div class="mb-3">
                            <label for="editStatus" class="form-label">Status</label>
                            <select class="form-control" id="editStatus" name="status">
                                <option value="Tersedia">Tersedia</option>
                                <option value="Habis">Habis</option>
                            </select>
                        </div>
                        <input type="hidden" id="editId" name="id">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    $(document).ready(function () {
    // Inisialisasi DataTable
    $('#example').DataTable({
        paging: true,
        searching: true,
        info: true,
        lengthMenu: [10, 25, 50, 100],
        language: {
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
            paginate: {
                next: "Selanjutnya",
                previous: "Sebelumnya",
            },
            search: "Cari : ",
        },
    });

    $('#productModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Tombol yang memicu modal
    var detail = JSON.parse(button.attr('data-detail')); // Ambil data JSON dari atribut data-detail

    var modal = $(this);
    modal.find('#productName').text(detail.nama || ""); // Pastikan key sesuai dengan JSON
    modal.find('#productHarga').text(formatRupiah(detail.harga) || ""); 
    modal.find('#productDeskripsi').text(detail.deskripsi || "");
    modal.find('#productBrand').text(detail.brand || "");
    modal.find('#productUkuran').text(detail.ukuran || "");
    modal.find('#productVarian').text(detail.varian || "");

    function formatRupiah(angka) {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkarev.length; i++) if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
        return 'Rp ' + rupiah.split('', rupiah.length - 1).reverse().join('');
    }
    });

    // Edit Modal Handling
$('#editModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');  
    var nama = button.data('nama');
    var stok = button.data('stok');
    var status = button.data('status');

    var modal = $(this);
    modal.find('#editId').val(id);
    modal.find('#editNama').val(nama);
    modal.find('#editStok').val(stok);
    modal.find('#editStatus').val(status);
});

// Edit Form Handling
$('#editForm').on('submit', function(e) {
    e.preventDefault(); // Prevent default form submission

    // Collect form data
    var formData = {
        id: $('#editId').val(),
        nama: $('#editNama').val(),
        stok: $('#editStok').val(),
        status: $('#editStatus').val()
    };
    });

});
function confirmDelete(productId) {
    event.preventDefault(); // Mencegah form langsung dikirimkan
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Status produk akan diubah!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, ubah status!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika konfirmasi, kirimkan form
            document.getElementById('deleteForm' + productId).submit();
        }
    });
}
</script>



</body>
</html>