<?php
include 'includes/auth.php';
include 'includes/db.php';
include 'sidebar.php';

// Join orders dengan order_items
$result = $conn->query("
  SELECT 
    orders.id AS order_id,
    users.username AS user_name,
    order_items.product_name,
    order_items.quantity,
    order_items.price,
    orders.created_at
  FROM orders
  JOIN order_items ON orders.id = order_items.order_id
  JOIN users ON users.id = orders.user_id
  ORDER BY orders.id DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pesanan Masuk</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">
  <!-- Sidebar -->
  <div class="w-64 h-screen bg-gray-800 text-white p-6">
    <h2 class="text-2xl mb-8">Admin Panel</h2>
    <ul class="space-y-4">
      <li><a href="index.php" class="hover:text-gray-400">Dashboard</a></li>
      <li><a href="orders.php" class="hover:text-gray-400">Pesanan</a></li>
      <li><a href="logout.php" class="hover:text-gray-400">Logout</a></li>
    </ul>
  </div>

  <!-- Main content -->
  <div class="flex-1 p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Pesanan</h1>
    <a href="index.php" class="mb-4 inline-block bg-blue-400 hover:bg-blue-200 px-4 py-2 rounded transition-colors duration-200">Kembali ke dashboard</a>

    <div class="bg-white rounded shadow p-4 overflow-x-auto">
      <table class="w-full text-left">
        <thead>
          <tr>
            <th class="border-b p-2">ID</th>
            <th class="border-b p-2">Nama User</th>
            <th class="border-b p-2">Menu</th>
            <th class="border-b p-2">Jumlah</th>
            <th class="border-b p-2">Harga</th>
            <th class="border-b p-2">Waktu</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
              <td class='p-2 border-b'>{$row['order_id']}</td>
              <td class='p-2 border-b'>{$row['user_name']}</td>
              <td class='p-2 border-b'>{$row['product_name']}</td>
              <td class='p-2 border-b'>{$row['quantity']}</td>
              <td class='p-2 border-b'>Rp " . number_format($row['price'], 0, ',', '.') . "</td>
              <td class='p-2 border-b'>{$row['created_at']}</td>
            </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>