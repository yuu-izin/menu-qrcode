<?php
session_start();
include 'data.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['add'])) {
    $id = $_GET['add'];
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
    header("Location: menu.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Menu QR Code</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
 body {
      font-family: 'Poppins', sans-serif;
    }
    .nav-link:hover, .navbar-brand:hover {
      border-radius: 5px;
      color:rgb(45, 185, 57);
      transition: 0.2s ease-in-out;
    }
    .card:hover {
      transform: scale(1.03);
      transition: 0.3s ease-in-out;
      box-shadow: 0 18px 20px rgba(0,0,0,0.2);
    }
    .card-img-top {
      width: 100%;
      height: 250px;
      object-fit: cover;
    }

    .banner {
      background: linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,0,0,0.3)), url('asset/banner.jpg');
      background-size: cover;
      background-position: center;
      color: white;
      padding: 100px 20px;
      text-align: center;
    }
    .banner h1 {
      font-weight: 700;
      font-size: 3rem;
    }


</style>

</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">
            FoodOrder
        </a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="menu.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="cart.php">Pesanan</a></li>
                <li class="nav-item"><a class="nav-link" href="checkout.php">Checkout</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Banner -->
<div class="banner mb-5">
  <h1>Selamat Datang di Restoran Kami</h1>
  <p class="lead mt-3">Silahkan Pilih Makanan Yg anda Inginkan Hari Ini</p>
</div>


<div class="container">
    <div class="row">
        <?php foreach ($menu as $item): ?>
            <div class="col-md-4 mb-5">
                <div class="card h-100">
                    <img src="<?= $item['gambar'] ?>" class="card-img-top" alt="<?= $item['nama'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $item['nama'] ?></h5>
                        <p class="card-text"><?= $item['deskripsi'] ?></p>
                        <p class="text-success"><strong>Rp<?= number_format($item['harga']) ?></strong></p>
                        <a href="menu.php?add=<?= $item['id'] ?>" class="btn btn-success w-100">Tambah ke Keranjang</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
