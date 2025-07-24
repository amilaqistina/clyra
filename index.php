<?php
session_start();

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin_dashboard.php");
    } else {
        header("Location: homepage.php");
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome to CLYRA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f3e8ff;
    }
    .hero {
      padding: 80px 20px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="hero">
    <h1>Welcome to CLYRA</h1>
    <p class="lead">Club Registration System</p>
    <a href="login.php" class="btn btn-primary">Login</a>
    <a href="register.php" class="btn btn-outline-secondary">Register</a>
  </div>
</body>
</html>


