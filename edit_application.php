<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid application ID.");
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM applications WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$app = $result->fetch_assoc();

if (!$app) {
    die("Application not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'];
    $update = $conn->prepare("UPDATE applications SET status = ? WHERE id = ?");
    $update->bind_param("si", $status, $id);
    $update->execute();
    header("Location: admin_dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Application - CLYRA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="card mx-auto" style="max-width: 500px;">
    <div class="card-body">
      <h4 class="mb-3">Edit Application Status</h4>
      <form method="POST">
        <div class="mb-3">
          <label>Status</label>
          <select name="status" class="form-select">
            <option value="Pending" <?= $app['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
            <option value="Approved" <?= $app['status'] === 'Approved' ? 'selected' : '' ?>>Approved</option>
            <option value="Rejected" <?= $app['status'] === 'Rejected' ? 'selected' : '' ?>>Rejected</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="admin_dashboard.php" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
</div>
</body>
</html>