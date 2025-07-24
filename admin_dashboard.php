<?php
session_start();
include 'db.php';
include 'header.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: homepage.php");
    exit;
}

// Fetch data
$users = $conn->query("SELECT * FROM users");
$applications = $conn->query("SELECT a.id, a.status, u.full_name, a.club_name 
                              FROM applications a 
                              JOIN users u ON a.user_id = u.id");
?>

<div class="container py-5">
  <h2 class="text-center mb-5 text-dark">Admin Dashboard</h2>

  <!-- USERS TABLE -->
  <div class="card mb-5 shadow-sm">
    <div class="card-header bg-purple text-white">
      <h5 class="mb-0">Registered Users</h5>
    </div>
    <div class="card-body p-0">
      <table class="table table-striped mb-0">
        <thead class="table-light">
          <tr>
            <th>Full Name</th>
            <th>Student ID</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Username</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($u = $users->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($u['full_name']) ?></td>
              <td><?= htmlspecialchars($u['student_id']) ?></td>
              <td><?= htmlspecialchars($u['email']) ?></td>
              <td><?= htmlspecialchars($u['phone']) ?></td>
              <td><?= htmlspecialchars($u['username']) ?></td>
              <td>
                <a href="admin_edit_user.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="admin_delete_user.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- CLUB APPLICATIONS TABLE -->
  <div class="card shadow-sm mb-5">
    <div class="card-header bg-purple text-white">
      <h5 class="mb-0">Club Applications</h5>
    </div>
    <div class="card-body p-0">
      <table class="table table-striped mb-0">
        <thead class="table-light">
          <tr>
            <th>User</th>
            <th>Club</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($app = $applications->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($app['full_name']) ?></td>
              <td><?= htmlspecialchars($app['club_name']) ?></td>
              <td><?= htmlspecialchars($app['status']) ?></td>
              <td>
                <?php if ($app['status'] === 'Pending'): ?>
                  <a href="admin_club_action.php?action=approve&id=<?= $app['id'] ?>" class="btn btn-sm btn-success">Approve</a>
                  <a href="admin_club_action.php?action=reject&id=<?= $app['id'] ?>" class="btn btn-sm btn-danger">Reject</a>
                <?php else: ?>
                  <span class="text-muted">No Action</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<style>
  body {
    background-color: #f3e8ff;
  }
  .bg-purple {
    background-color: #6f42c1 !important;
  }
  .text-purple {
    color: #6f42c1;
  }
</style>
