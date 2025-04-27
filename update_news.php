<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'mahan') {
    header("Location: index.php");
    exit;
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $source = $_POST['source'];
    $agency = $_POST['agency'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // آپلود تصویر جدید (اگر انتخاب شده باشد)
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $target_file);

        // به‌روزرسانی خبر با تصویر جدید
        $stmt = $pdo->prepare("UPDATE news SET source = ?, agency = ?, title = ?, content = ?, image_url = ? WHERE id = ?");
        $stmt->execute([$source, $agency, $title, $content, $target_file, $id]);
    } else {
        // به‌روزرسانی خبر بدون تغییر تصویر
        $stmt = $pdo->prepare("UPDATE news SET source = ?, agency = ?, title = ?, content = ? WHERE id = ?");
        $stmt->execute([$source, $agency, $title, $content, $id]);
    }

    header("Location: admin.php");
    exit;
}
?>