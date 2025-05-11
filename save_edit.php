<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'mahan') {
    die("دسترسی غیرمجاز.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $new_comment = filter_input(INPUT_POST, 'edited_comment', FILTER_SANITIZE_STRING);

    if (!$new_comment) {
        die("نظر نمیتواند خالی باشد.");
    }

    $stmt = $pdo->prepare("UPDATE comments SET comment = ? WHERE id = ?");
    $stmt->execute([$new_comment, $id]);

    header("Location: comments.php");
    exit;
}
?>