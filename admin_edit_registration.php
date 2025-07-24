<?php
session_start();
include 'db.php';
include 'header.php';

if ($_SESSION['role'] !== 'admin') {
  header("Location: homepage.php");
  exit;
}

$id = $_GET['id'];
$reg = $conn->query("SELECT * FROM registrations WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $event_id = $_POST['event_id'];
  $conn->query("UPDATE registrations SET event_id=$event_id WHERE id=$id");
  header("Location: admin_dashboard.php");
  exit;
}
?>

<div class="container py-5">
  <div class="card shadow-lg mx-auto" style="max-width: 600px;">
    <div class="card-header bg-purple text-white">
      <h4 class="mb-0">Edit Registration</h4>
    </div>
    <div class="card-body">
      <form method="POST">
        <div class="mb-3">
          <label>Event ID</label>
          <input type="number" name="event_id" value="<?= $reg['event_id'] ?>" class="form-control" required>
        </div>
        <button class="btn btn-success">Update</button>
      </form>
    </div>
  </div>
</div>

<style>
  .bg-purple {
    background-color: #6f42c1;
  }
</style>

<?php include 'footer.php'; ?>
