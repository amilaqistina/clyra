<?php
session_start();
include 'db.php';
include 'header.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: homepage.php");
  exit;
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $full_name = $_POST['full_name'];
  $student_id = $_POST['student_id'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $username = $_POST['username'];

  // Handle picture upload
  if (!empty($_FILES['picture']['name'])) {
    $ext = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
    $filename = uniqid('pic_') . "." . $ext;
    move_uploaded_file($_FILES['picture']['tmp_name'], "uploads/$filename");
    $update = $conn->prepare("UPDATE users SET full_name=?, student_id=?, email=?, phone=?, username=?, picture=? WHERE id=?");
    $update->bind_param("ssssssi", $full_name, $student_id, $email, $phone, $username, $filename, $id);
  } else {
    $update = $conn->prepare("UPDATE users SET full_name=?, student_id=?, email=?, phone=?, username=? WHERE id=?");
    $update->bind_param("sssssi", $full_name, $student_id, $email, $phone, $username, $id);
  }
  $update->execute();
  header("Location: admin_dashboard.php");
  exit;
}
?>

<div class="container py-5">
  <h2 class="text-center text-dark mb-4">Edit User</h2>
  <div class="card shadow-sm">
    <div class="card-body">
      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label">Full Name</label>
          <input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars($user['full_name']) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Student ID</label>
          <input type="text" name="student_id" class="form-control" value="<?= htmlspecialchars($user['student_id']) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Phone</label>
          <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Profile Picture</label><br>
          <img src="uploads/<?= htmlspecialchars($user['picture']) ?>" class="mb-2" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;">
          <input type="file" name="picture" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
      </form>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
