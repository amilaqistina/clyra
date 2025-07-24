<?php
session_start();
include 'db.php';
include 'header.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_id'];

// Dapatkan maklumat users
$stmt = $conn->prepare("SELECT full_name, student_id, email, phone, username, picture FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Dapatkan kelab users
$clubs = $conn->prepare("SELECT club_name FROM applications WHERE user_id = ? AND status = 'Approved'");
$clubs->bind_param("i", $user_id);
$clubs->execute();
$club_result = $clubs->get_result();
?>

<div class="container py-5">
  <div class="card mx-auto" style="max-width: 600px;">
    <div class="card-body text-center">
      <img src="uploads/<?= htmlspecialchars($user['picture']) ?>" class="rounded-circle mb-3" width="120" height="120" alt="Profile Picture">
      <h3 class="mb-2">@<?= htmlspecialchars($user['username']) ?></h3>
      <p class="text-muted mb-4">ID: <?= htmlspecialchars($user['student_id']) ?> | <?= htmlspecialchars($user['email']) ?></p>
      <p><strong>Name:</strong> <?= htmlspecialchars($user['full_name']) ?></p>
      <p><strong>Phone:</strong> <?= htmlspecialchars($user['phone']) ?></p>
      <hr>
      <h5 class="mb-3">Joined Clubs</h5>
      <?php if ($club_result->num_rows): ?>
        <ul class="list-group">
          <?php while ($c = $club_result->fetch_assoc()): ?>
            <li class="list-group-item">✅ <?= htmlspecialchars($c['club_name']) ?></li>
          <?php endwhile; ?>
        </ul>
      <?php else: ?>
        <p class="text-muted">No approved club registrations yet.</p>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>