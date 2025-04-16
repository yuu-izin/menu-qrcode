<?php
session_start();
include 'data.php';

$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Konfirmasi Pesanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
  <a class="navbar-brand fs-3" href="index.php">MenuQR</a>
  <div class="collapse navbar-collapse justify-content-end">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link fs-5" href="menu.php">Home</a></li>
      <li class="nav-item"><a class="nav-link fs-5" href="cart.php">Pesanan</a></li>
    </ul>
  </div>
</nav>

<div class="container mt-5 mb-5">
  <div class="card shadow p-4 mx-auto" style="max-width: 700px;">
    <h3 class="text-center mb-4">Ringkasan Pesanan</h3>

    <?php if (!empty($cart)): ?>
      <table class="table table-bordered">
        <thead class="table-light">
          <tr>
            <th>Menu</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($cart as $id => $jumlah):
            foreach ($menu as $item) {
              if ($item['id'] == $id) {
                $nama = $item['nama'];
                $harga = $item['harga'];
                $subtotal = $harga * $jumlah;
                $total += $subtotal;
          ?>
          <tr>
            <td><?= htmlspecialchars($nama) ?></td>
            <td>Rp<?= number_format($harga, 0, ',', '.') ?></td>
            <td><?= $jumlah ?></td>
            <td>Rp<?= number_format($subtotal, 0, ',', '.') ?></td>
          </tr>
          <?php break; } } endforeach; ?>
        </tbody>
        <tfoot class="table-light">
          <tr>
            <th colspan="3" class="text-end">Total:</th>
            <th>Rp<?= number_format($total, 0, ',', '.') ?></th>
          </tr>
        </tfoot>
      </table>

      <div class="alert alert-info text-center fs-5 mt-4">
        Apakah pesanan Anda sudah benar?
      </div>

      <div class="d-flex justify-content-between mt-3">
        <a href="cart.php" class="btn btn-secondary">Kembali</a>
        <a href="selesai.php" class="btn btn-success">Checkout Sekarang</a>
      </div>
    <?php else: ?>
      <div class="alert alert-warning text-center">Tidak ada pesanan yang ditemukan. <a href="menu.php">Pilih Menu</a></div>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
