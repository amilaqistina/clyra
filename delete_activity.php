<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $activity_id = intval($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM activities WHERE id = ?");
    $stmt->bind_param("i", $activity_id);
    $stmt->execute();
}

header("Location: admin_dashboard.php");
exit;
?>
