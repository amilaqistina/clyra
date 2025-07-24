<?php

session_start();
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: homepage.php");
    exit;
}

// Dapatkan registration ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Kalau ID valid, delete maklumat registration
if ($id > 0) {
    $conn->query("DELETE FROM registrations WHERE id = $id");
}

header("Location: admin_dashboard.php");
exit;
?>
