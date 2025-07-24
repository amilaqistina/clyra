<?php
include 'header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$username = $_SESSION['username'];
$picture = $_SESSION['picture'];
?>

<div class="container mt-5">
  <h2 class="mb-4">Latest Club Announcements</h2>
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card border-primary shadow">
        <div class="card-body">
          <h5 class="card-title">Join Imarah Surau with JPK DO!</h5>
          <p class="card-text">Let’s join Imarah Surau to strengthen our faith, build brotherhood, and grow together through spiritual and community activities!</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-success shadow">
        <div class="card-body">
          <h5 class="card-title">TR: Fun Run</h5>
          <p class="card-text">Join TR: Fun Run for a day of fun, fitness, and friendship—let’s run together and make every step count!</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-info shadow">
        <div class="card-body">
          <h5 class="card-title">Cultural Fest</h5>
          <p class="card-text">Celebrate diversity and unity—join our Cultural Festival for a colorful journey of traditions, food, and performances from all around!</p>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>
