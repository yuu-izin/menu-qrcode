<?php
include 'includes/auth.php';
include 'includes/db.php';
include 'sidebar.php';

// Total pesanan
$total_orders = $conn->query("SELECT COUNT(*) AS total FROM orders")->fetch_assoc()['total'];

// Menu terlaris
$menu_terlaris = $conn->query("
  SELECT product_name, SUM(quantity) as total_qty 
  FROM order_items 
  GROUP BY product_name 
  ORDER BY total_qty DESC 
  LIMIT 1
")->fetch_assoc();
$menu_terlaris_nama = $menu_terlaris ? $menu_terlaris['product_name'] : '-';

// Total pendapatan
$total_pendapatan = $conn->query("SELECT SUM(total) AS total FROM order_items")->fetch_assoc()['total'] ?? 0;

// Pesanan hari ini
$today = date('Y-m-d');
$pesanan_hari_ini = $conn->query("SELECT COUNT(*) AS total FROM orders WHERE DATE(created_at) = '$today'")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <!-- Sidebar -->
  <div style="width: 220px; height: 100vh; position: fixed; top: 0; left: 0; background: #2c3e50; color: white; padding: 20px;">
    <h2 style="margin-bottom: 30px;">Admin Panel</h2>
    <ul style="list-style: none; padding: 0;">
        <li style="margin-bottom: 15px;">
            <a href="index.php" style="color: white; text-decoration: none;">Dashboard</a>
        </li>
        <li style="margin-bottom: 15px;">
            <a href="orders.php" style="color: white; text-decoration: none;">Pesanan</a>
        </li>
        <li style="margin-bottom: 15px;">
            <a href="logout.php" style="color: white; text-decoration: none;">Logout</a>
        </li>
    </ul>
  </div>

  <!-- Konten utama -->
  <main class="ml-[220px] p-6 overflow-y-auto min-h-screen">
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl font-bold">Dashboard Admin</h1>
      <a href="logout.php" class="text-red-500">Logout</a>
    </div>

    <h1 class="text-3xl font-bold mb-6">Dashboard Admin</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Total Pesanan -->
      <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold">Total Pesanan</h2>
        <p class="mt-4 text-2xl font-bold"><?= $total_orders ?></p>
      </div>
      <!-- Menu Terlaris -->
      <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold">Menu Terlaris</h2>
        <p class="mt-4 text-2xl font-bold"><?= htmlspecialchars($menu_terlaris_nama) ?></p>
      </div>
      <!-- Total Pendapatan -->
      <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold">Total Pendapatan</h2>
        <p class="mt-4 text-2xl font-bold">Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></p>
      </div>
      <!-- Pesanan Hari Ini -->
      <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold">Pesanan Hari Ini</h2>
        <p class="mt-4 text-2xl font-bold"><?= $pesanan_hari_ini ?></p>
      </div>
    </div>

    <!-- Notifikasi Pesanan -->
    <div class="mt-8">
      <h2 class="text-2xl font-bold mb-4">Notifikasi Pesanan</h2>
      <div class="bg-white shadow rounded-lg p-4">
        <p>Tidak ada notifikasi baru.</p>
      </div>
    </div>

    <a href="orders.php" class="mt-6 inline-block bg-blue-500 text-white px-4 py-2 rounded">Lihat Pesanan</a>
  </main>
</body>
</html>