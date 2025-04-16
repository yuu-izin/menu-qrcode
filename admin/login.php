<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: index.php");
    } else {
        $error = "Login gagal!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
  <form method="POST" class="bg-white p-6 rounded shadow-md w-80">
    <h2 class="text-xl mb-4 font-bold text-center">Login Admin</h2>
    <?php if (!empty($error)) echo "<p class='text-red-500'>$error</p>"; ?>
    <input type="text" name="username" placeholder="Username" class="w-full p-2 border mb-3" required>
    <input type="password" name="password" placeholder="Password" class="w-full p-2 border mb-3" required>
    <button class="bg-blue-500 text-white px-4 py-2 w-full">Login</button>
  </form>
</body>
</html>
