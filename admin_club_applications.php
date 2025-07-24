<?php
session_start();
include 'db.php';
include 'header.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: homepage.php");
  exit;
}

// Approval/rejection by admin
if (isset($_GET['action'], $_GET['id'])) {
  $id = intval($_GET['id']);
  $status = ($_GET['action'] === 'approve') ? 'Approved' : 'Rejected';
  $conn->query("UPDATE applications SET status='$status' WHERE id = $id");
  header("Location: admin_club_applications.php");
  exit;
}

$query = "SELECT a.*, u.full_name, u.student_id, c.name AS club_name
          FROM applications a
          JOIN users u ON a.user_id = u.id
          JOIN clubs c ON a.club_id = c.id
          ORDER BY a.id DESC";
$result = $conn->query($query);
?>

<h2 class="text-black mb-4 text-center">Club Applications</h2>

<div class="card shadow-sm">
  <div class="card-body">
    <?php if ($result->num_rows > 0): ?>
      <table class="table table-bordered table-hover table-sm">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Student Name</th>
            <th>Student ID</th>
            <th>Club</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?= htmlspecialchars($row['full_name']) ?></td>
              <td><?= htmlspecialchars($row['student_id']) ?></td>
              <td><?= htmlspecialchars($row['club_name']) ?></td>
              <td><?= htmlspecialchars($row['status']) ?></td>
              <td>
                <?php if ($row['status'] === 'Pending'): ?>
                  <a href="?action=approve&id=<?= $row['id'] ?>" class="btn btn-sm btn-success">Approve</a>
                  <a href="?action=reject&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger">Reject</a>
                <?php else: ?>
                  <span class="text-muted">No Action</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p class="text-muted">No club applications found.</p>
    <?php endif; ?>
  </div>
</div>

<?php include 'footer.php'; ?>
