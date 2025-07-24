<?php
session_start();
include 'db.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_or_username = trim($_POST['email_or_username']);
    $password = trim($_POST['password']);

    // Check admin
    if ($email_or_username === 'adminclyra@gmail.com' && $password === 'admin123') {
        $_SESSION['user_id'] = 0;
        $_SESSION['username'] = 'admin';
        $_SESSION['email'] = 'adminclyra@gmail.com';
        $_SESSION['picture'] = 'default.png';
        $_SESSION['role'] = 'admin';
        header("Location: homepage.php");
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $email_or_username, $email_or_username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['picture'] = $user['picture'];
        $_SESSION['role'] = $user['role'];
        header("Location: homepage.php");
        exit;
    } else {
        $errors[] = "Invalid email/username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - CLYRA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f3e8ff; /* Light purple */
    }
    .card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 10px 25px rgba(111, 66, 193, 0.15);
    }
    .btn-primary {
      background-color: #6f42c1;
      border-color: #6f42c1;
    }
    .btn-primary:hover {
      background-color: #5a35a3;
    }
    .logo-img {
      height: 60px;
    }
  </style>
</head>
<body>
<div class="container py-5">
  <div class="card mx-auto p-4" style="max-width: 480px;">
    <div class="text-center">
      <!-- Replace 'logo.png' with your actual logo file -->
      <img src="uploads/logo.png" alt="CLYRA Logo" class="logo-img mb-2">
      <h4 class="fw-bold">CLYRA Login Portal</h4>
      <p class="text-muted">Welcome back! Please login to continue.</p>
    </div>

    <?php foreach ($errors as $error): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endforeach; ?>

    <form method="POST" class="mt-3">
      <div class="mb-3">
        <label>Email or Username</label>
        <input type="text" name="email_or_username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <p class="mt-3 text-center">
      Don't have an account? <a href="register.php" class="text-decoration-none">Register here</a>
    </p>
  </div>
</div>
</body>
</html>
