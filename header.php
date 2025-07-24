<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CLYRA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body {
      background-color: #f3e8ff; 
    }
    .navbar {
      background-color: #6f42c1;
    }
    .navbar .nav-link,
    .navbar .navbar-text {
      color: white !important;
    }
    .navbar .nav-link:hover {
      color: #d1b3ff !important;
    }
    .profile-img {
      width: 35px;
      height: 35px;
      object-fit: cover;
      border-radius: 50%;
      margin-left: 10px;
      border: 2px solid #fff;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark px-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="homepage.php">CLYRA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
          <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Dashboard</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="browse_clubs.php">Clubs</a></li>
        <?php endif; ?>
      </ul>

      <ul class="navbar-nav ms-auto">
        <?php if (isset($_SESSION['username'])): ?>
          <li class="nav-item">
            <span class="navbar-text">
              Welcome, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>
            </span>
          </li>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] !== 'admin'): ?>
          <li class="nav-item">
            <a href="profile.php">
            <img src="uploads/<?= htmlspecialchars($_SESSION['picture'] ?? 'default.png') ?>" class="profile-img" alt="Profile">
            </a>
          </li>
        <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link" href="logout.php" title="Logout">
              <i class="bi bi-power"></i>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container py-4">
