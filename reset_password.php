<?php
session_start();
include 'db.php';

$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email']);
  $newpass = trim($_POST['new_password']);

  if (!$email || !$newpass) {
    $error = "Please fill in all fields.";
  } else {
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 0) {
      $error = "No account found with that email.";
    } else {
      $hashed = password_hash($newpass, PASSWORD_DEFAULT);
      $update = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
      $update->bind_param("ss", $hashed, $email);
      if ($update->execute()) {
        $success = "Password reset successfully. You can now <a href='login.php'>login</a>.";
      } else {
        $error = "Something went wrong. Please try again.";
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Password - CRAMS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="card mx-auto" style="max-width: 450px;">
    <div class="card-body">
      <h3 class="mb-3 text-center">Reset Your Password</h3>

      <?php if ($error): ?>
        <div class="alert alert-danger text-center"> <?= $error ?> </div>
      <?php elseif ($success): ?>
        <div class="alert alert-success text-center"> <?= $success ?> </div>
      <?php endif; ?>

      <form method="POST">
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>New Password</label>
          <input type="password" name="new_password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Reset Password</button>
        <p class="mt-3 text-center"><a href="login.php">Back to Login</a></p>
      </form>
    </div>
  </div>
</div>
</body>
</html>
