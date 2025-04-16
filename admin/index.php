<?php
include 'includes/auth.php';
include 'sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-4">
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Dashboard Admin</h1>
    <a href="logout.php" class="text-red-500">Logout</a>
  </div>

  <a href="orders.php" class="bg-blue-500 text-white px-4 py-2 rounded">Lihat Pesanan</a>
</body>
</html>
