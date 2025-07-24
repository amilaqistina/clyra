<?php
session_start();
include 'db.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name']);
    $student_id = trim($_POST['student_id']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $picture = $_FILES['picture'];

    if (!$full_name || !$student_id || !$email || !$phone || !$username || !$password || !$picture['name']) {
        $errors[] = "All fields including profile picture are required.";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $check = $stmt->get_result();
        if ($check->num_rows > 0) {
            $errors[] = "Email already registered.";
        }
    }

    if (empty($errors)) {
        $ext = pathinfo($picture['name'], PATHINFO_EXTENSION);
        $filename = uniqid('pic_') . "." . $ext;
        move_uploaded_file($picture['tmp_name'], "uploads/$filename");

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (full_name, student_id, email, phone, username, password, picture) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $full_name, $student_id, $email, $phone, $username, $hash, $filename);

        if ($stmt->execute()) {
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['username'] = $username;
            $_SESSION['picture'] = $filename;
            $_SESSION['role'] = 'user';
            header("Location: homepage.php");
            exit;
        } else {
            $errors[] = "Registration failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - CLYRA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f3e8ff;
    }
    .card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 10px 20px rgba(148, 0, 211, 0.1);
    }
    .btn-primary {
      background-color: #6f42c1;
      border-color: #6f42c1;
    }
    .btn-primary:hover {
      background-color: #5a35a3;
    }
  </style>
</head>
<body>
<div class="container py-5">
  <div class="card mx-auto" style="max-width: 550px;">
    <div class="card-body">
      <h3 class="mb-4 text-center text-purple fw-bold">Student Registration</h3>
      
      <?php foreach ($errors as $error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php endforeach; ?>
      
      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label>Full Name</label>
          <input type="text" name="full_name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Student ID</label>
          <input type="text" name="student_id" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Phone</label>
          <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Username</label>
          <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Profile Picture</label>
          <input type="file" name="picture" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
      </form>

      <p class="mt-3 text-center">
        Already have an account? <a href="login.php" class="text-decoration-none text-purple">Login here</a>
      </p>
    </div>
  </div>
</div>
</body>
</html>
