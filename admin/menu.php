<?php
include 'includes/auth.php';
include 'includes/db.php';
include 'sidebar.php';

// Handle tambah
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stmt = $conn->prepare("INSERT INTO menus (name, price) VALUES (?, ?)");
    $stmt->bind_param("sd", $name, $price);
    $stmt->execute();
    header("Location: menu.php");
    exit;
}

// Handle hapus
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM menus WHERE id = $id");
    header("Location: menu.php");
    exit;
}

// Ambil semua menu
$menus = $conn->query("SELECT * FROM menus ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Kelola Menu</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-4">
  <h1 class="text-2xl font-bold mb-4">Kelola Menu</h1>
  <a href="index.php" class="text-blue-500 underline mb-4 inline-block">← Kembali ke dashboard</a>

  <!-- Form Tambah Menu -->
  <div class="bg-white rounded shadow p-4 mb-6">
    <form method="POST" class="flex gap-4">
      <input type="text" name="name" placeholder="Nama menu" required class="border p-2 rounded w-1/2">
      <input type="number" step="0.01" name="price" placeholder="Harga" required class="border p-2 rounded w-1/4">
      <button type="submit" name="tambah" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</button>
    </form>
  </div>

  <!-- Tabel Menu -->
  <div class="bg-white rounded shadow p-4">
    <table class="w-full text-left">
      <thead>
        <tr>
          <th class="border-b p-2">#</th>
          <th class="border-b p-2">Nama</th>
          <th class="border-b p-2">Harga</th>
          <th class="border-b p-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; while ($row = $menus->fetch_assoc()): ?>
          <tr>
            <td class="p-2 border-b"><?= $i++ ?></td>
            <td class="p-2 border-b"><?= htmlspecialchars($row['name']) ?></td>
            <td class="p-2 border-b">Rp <?= number_format($row['price'], 0, ',', '.') ?></td>
            <td class="p-2 border-b">
              <!-- Tombol Hapus -->
              <a href="menu.php?hapus=<?= $row['id'] ?>" onclick="return confirm('Hapus menu ini?')" class="text-red-500">Hapus</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>