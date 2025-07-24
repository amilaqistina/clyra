<?php

session_start();
include 'db.php';

// Pastikan hanya admin boleh access
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: homepage.php");
    exit;
}

// Dapatkan user ID untuk delete
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Elak admin dari buang maklumat sendiri
if ($id > 0 && $id !== $_SESSION['user_id']) {
    // Delete user profile picture dari folder uploads
    $getUser = $conn->query("SELECT picture FROM users WHERE id = $id");
    if ($getUser && $getUser->num_rows > 0) {
        $user = $getUser->fetch_assoc();
        $pic = $user['picture'];
        if ($pic && file_exists("uploads/$pic")) {
            unlink("uploads/$pic"); 
        }
    }

    // Delete user
    $conn->query("DELETE FROM users WHERE id = $id");
}

header("Location: admin_dashboard.php");
exit;
?>
