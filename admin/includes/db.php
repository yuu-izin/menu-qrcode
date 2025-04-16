<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "qrcode_app"; // Sesuaikan kalau beda

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
