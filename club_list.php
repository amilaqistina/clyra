<?php
session_start();
include 'db.php';
include 'header.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_id'];
$category = $_GET['category'] ?? '';
$club_name = $_GET['club'] ?? '';

if (!$category || !$club_name) {
  echo "<p class='text-danger p-4'>Invalid club selection. <a href='browse_clubs.php'>Back to Browse</a></p>";
  exit;
}

// Handle registration form
$registered = false;
$success = "";

$stmt = $conn->prepare("SELECT * FROM applications WHERE user_id = ? AND club_name = ?");
$stmt->bind_param("is", $user_id, $club_name);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
  $registered = true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$registered) {
  $stmt = $conn->prepare("INSERT INTO applications (user_id, club_name, status) VALUES (?, ?, 'Pending')");
  $stmt->bind_param("is", $user_id, $club_name);
  if ($stmt->execute()) {
    $registered = true;
    $success = "You have applied to join $club_name. Please wait for approval.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($club_name) ?> - Apply</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="card mx-auto" style="max-width: 600px">
    <div class="card-body">
      <h3 class="mb-3 text-center">Apply for <?= htmlspecialchars($club_name) ?></h3>
      <p class="text-muted text-center">Category: <?= htmlspecialchars($category) ?></p>

      <?php if ($success): ?>
        <div class="alert alert-success text-center"> <?= $success ?> </div>
      <?php elseif ($registered): ?>
        <div class="alert alert-info text-center"> You have already applied for this club. </div>
      <?php else: ?>
        <form method="POST" class="text-center">
          <button type="submit" class="btn btn-primary">Register for <?= htmlspecialchars($club_name) ?></button>
        </form>
      <?php endif; ?>

      <div class="text-center mt-3">
        <a href="browse_clubs.php" class="btn btn-link">← Back to Browse</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>