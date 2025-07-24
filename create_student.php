<?php
include 'database.php';

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $faculty_id = intval($_POST["faculty_id"]);

    if ($name && $email && $password && $faculty_id) {
        $stmt = $conn->prepare("INSERT INTO students (name, email, password, faculty_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $name, $email, $password, $faculty_id);

        if ($stmt->execute()) {
            $success = "Student registered successfully.";
        } else {
            $error = "Error: " . $stmt->error;
        }
    } else {
        $error = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register New Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="card shadow p-4 mx-auto" style="max-width: 500px;">
    <h2 class="mb-4 text-center">Register New Student</h2>

    <?php if ($success): ?>
      <div class="alert alert-success text-center"><?= htmlspecialchars($success) ?></div>
    <?php elseif ($error): ?>
      <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" placeholder="Student Name" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" placeholder="example@email.com" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Faculty ID</label>
        <input type="number" name="faculty_id" class="form-control" placeholder="e.g. 1" required>
      </div>

      <button type="submit" class="btn btn-success w-100">Submit</button>
    </form>

    <div class="text-center mt-3">
      <a href="index.php" class="btn btn-link">← Back to List</a>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
