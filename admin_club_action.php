<?php
session_start();
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: homepage.php");
  exit;
}

if (isset($_GET['action'], $_GET['id'])) {
  $id = intval($_GET['id']);
  $action = $_GET['action'];

  if ($action === 'approve') {
    $conn->query("UPDATE applications SET status='Approved' WHERE id = $id");
  } elseif ($action === 'reject') {
    $conn->query("UPDATE applications SET status='Rejected' WHERE id = $id");
  }
}

header("Location: admin_dashboard.php");
exit;
?>
