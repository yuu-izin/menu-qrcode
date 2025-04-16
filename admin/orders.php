<?php
include 'includes/auth.php';
include 'includes/db.php';
include 'sidebar.php';

$result = $conn->query("SELECT * FROM orders");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pesanan Masuk</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-4">
  <h1 class="text-2xl font-bold mb-4">Daftar Pesanan</h1>
  <a href="index.php" class="text-blue-500 underline mb-4 inline-block">← Kembali ke dashboard</a>

  <div class="bg-white rounded shadow p-4">
    <table class="w-full text-left">
      <thead>
        <tr>
          <th class="border-b p-2">Id</th>
          <th class="border-b p-2">Nama</th>
          <th class="border-b p-2">Menu</th>
          <th class="border-b p-2">Jumlah</th>
          <th class="border-b p-2">Catatan</th>
          <th class="border-b p-2">Waktu</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
            <td class='p-2 border-b'>{$i}</td>
            <td class='p-2 border-b'>{$row['nama']}</td>
            <td class='p-2 border-b'>{$row['menu']}</td>
            <td class='p-2 border-b'>{$row['jumlah']}</td>
            <td class='p-2 border-b'>{$row['catatan']}</td>
            <td class='p-2 border-b'>{$row['waktu']}</td>
          </tr>";
          $i++;
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
