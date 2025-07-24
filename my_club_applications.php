<?php
session_start();
include 'db.php';
include 'header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch users club application
$result = $conn->query("
  SELECT a.*, c.name AS club_name 
  FROM applications a 
  JOIN clubs c ON a.club_id = c.id 
  WHERE a.user_id = $user_id 
  ORDER BY a.id DESC
");
?>

<h4 class="text-black mb-4">My Club Applications</h4>

<table class="table table-bordered table-sm">
  <thead class="table-light">
    <tr>
      <th>#</th>
      <th>Club</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($result->num_rows > 0): $i = 1; ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $i++ ?></td>
          <td><?= htmlspecialchars($row['club_name']) ?></td>
          <td>
            <span class="badge 
              <?= $row['status'] === 'Approved' ? 'bg-success' : ($row['status'] === 'Rejected' ? 'bg-danger' : 'bg-secondary') ?>">
              <?= $row['status'] ?>
            </span>
          </td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="3" class="text-muted text-center">No club applications yet.</td></tr>
    <?php endif; ?>
  </tbody>
</table>

<?php include 'footer.php'; ?>
