<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    echo "<script>alert('برای لایک کردن باید وارد شوید.'); window.location.href='login.php';</script>";
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // افزایش تعداد لایک
    $stmt = $pdo->prepare("UPDATE comments SET likes = likes + 1 WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: comments.php");
exit;
?>