<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'mahan') {
    header("Location: index.php");
    exit;
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $source = $_POST['source'];
    $agency = $_POST['agency'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_FILES['image'];

    // آپلود تصویر
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image['name']);
    move_uploaded_file($image['tmp_name'], $target_file);

    // ذخیره خبر در دیتابیس
    $stmt = $pdo->prepare("INSERT INTO news (source, agency, title, content, image_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$source, $agency, $title, $content, $target_file]);

    header("Location: admin.php");
    exit;
}
?>