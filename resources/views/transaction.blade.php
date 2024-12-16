<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Riwayat Transaksi</title>

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
  <link href="../assets/css/transaction.css" rel="stylesheet">

  <style>
    /* Styling tambahan untuk merapikan tampilan */
    .header-container {
      display: flex;
      align-items: center;
      gap: 10px; /* Jarak antara ikon dan judul */
      margin-bottom: 20px; /* Jarak antara judul dan tabel */
    }

    .header-container .home-link {
      font-size: 24px; /* Ukuran ikon */
      margin-left: 10px; /* Memberikan jarak dari ujung kiri */
      color: #dc3545; /* Warna ikon Home */
      text-decoration: none;
    }

    .header-title {
      font-size: 1.5em; /* Ukuran judul */
      color: #dc3545; /* Warna judul */
      margin: 0;
    }

    .table-container {
      margin-top: 15px; /* Jarak antara judul dan tabel */
    }
  </style>
</head>
<body>
  <div class="container mt-4">
    <!-- Home Link and Title -->
    <div class="header-container">
      <a href="{{ route('home') }}" class="home-link">
        <i class="fa fa-home"></i>
      </a>
    </div>
    <div>
    <h2 class="header-title">&nbsp;&nbsp;Transaction History</h2>
    </div>

    <!-- Transaction Table -->
    <div class="table-container table-responsive">
      @if($transactions->isEmpty())
      <p>Anda belum memiliki riwayat transaksi.</p>
      @else
      <table class="table table-striped table-hover">
        <thead class="table-primary">
          <tr>
            <th scope="col">Tanggal</th>
            <th scope="col">Total</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($transactions as $transaction)
            <tr>
              <td>{{ $transaction->created_at->format('d-m-Y H:i:s') }}</td>
              <td>{{ number_format($transaction->total, 2) }}</td>
              <td>
                @if($transaction->status == "Menunggu Konfirmasi" || $transaction->status == "Menunggu Pengambilan")
                <span class="badge bg-warning">{{ $transaction->status }}</span>
                @elseif($transaction->status == "Transaksi Selesai")
                <span class="badge bg-success">{{ $transaction->status }}</span>
                @else
                <span class="badge bg-danger">{{ $transaction->status }}</span>
                @endif
              </td>
              <td>
                <a href="{{ route('transaction.show', ['cartId' => $transaction->id]) }}" class="btn btn-info btn-sm">
                  <i class="fa fa-shopping-cart"></i> Lihat Cart
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      @endif
    </div>
  </div>
</body>
</html>
