<?php
session_start();
include 'data.php';

$cart = $_SESSION['cart'] ?? [];

// Update jumlah pesanan (jika form disubmit)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['jumlah'])) {
    foreach ($_POST['jumlah'] as $id => $jml) {
        if ($jml <= 0) {
            unset($_SESSION['cart'][$id]); // hapus jika jumlah 0
        } else {
            $_SESSION['cart'][$id] = $jml;
        }
    }
    header("Location: cart.php");
    exit;
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pesanan</title>
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
  <div class="card mx-auto shadow p-4" style="max-width: 700px;">
    <h3 class="text-center mb-4">Keranjang Pesanan</h3>

    <?php if (!empty($cart)): ?>
    <form method="POST" action="cart.php">
      <table class="table">
        <thead>
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
    <td>
      <select name="jumlah[<?= $id ?>]" class="form-select form-select-sm" style="width: 80px;">
        <?php for ($i = 0; $i <= 10; $i++): ?>
          <option value="<?= $i ?>" <?= $i == $jumlah ? 'selected' : '' ?>><?= $i ?></option>
        <?php endfor; ?>
      </select>
    </td>
    <td>Rp<?= number_format($subtotal, 0, ',', '.') ?></td>
  </tr>
<?php 
      break; // Keluar dari foreach menu
    }
  }
endforeach; 
?>

        </tbody>
      </table>

      <div class="text-end mb-3 fs-5">
        <strong>Total: Rp<?= number_format($total, 0, ',', '.') ?></strong>
      </div>

      <div class="d-flex justify-content-between">
        <a href="menu.php" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Update Jumlah</button>
        <a href="checkout.php" class="btn btn-success">Checkout</a>
      </div>
    </form>
    <?php else: ?>
      <div class="alert alert-warning text-center">Keranjang masih kosong. <a href="menu.php">Pilih Menu</a></div>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
