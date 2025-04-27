<?php
session_start();
include 'db.php';

// بررسی لاگین بودن کاربر
if (!isset($_SESSION['user'])) {
    echo "<script>alert('برای ثبت نظر باید وارد شوید.'); window.location.href='login.php';</script>";
    exit;
}

// ثبت نظر جدید
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $user_id = $_SESSION['user']['id'];
    $comment = $_POST['comment'];

    $stmt = $pdo->prepare("INSERT INTO comments (user_id, comment) VALUES (?, ?)");
    $stmt->execute([$user_id, $comment]);

    header("Location: comments.php");
    exit;
}

// انتخاب تمام نظرات
$stmt = $pdo->query("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id ORDER BY created_at DESC");
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظرات</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include 'header.php';
?>

    <main class="col-12 col-md-6">
        <h1 class="col-12 col-md-6 mx-auto">پژوهش های کاربران</h1>

        <!-- فرم ثبت نظر -->
        <form method="POST" class="col-12 col-md-12 mx-auto">
            <textarea class="col-12 col-md-12 mx-auto" name="comment" placeholder="نظر خود را بنویسید..." required></textarea>
            <button class="col-12 col-md-12 mx-auto" type="submit">ثبت نظر</button>
        </form>

        <!-- لیست نظرات -->
        <h2>پژوهش ها :</h2>
        <?php foreach ($comments as $item): ?>
            <div class="comment-item" class="col-12 col-md-12 mx-auto">
                <p><strong><?= htmlspecialchars($item['username']) ?>:</strong> <?= htmlspecialchars($item['comment']) ?></p>
                <span class="likes" class="col-12 col-md-12 mx-auto">👍 <?= $item['likes'] ?> <a href="like_comment.php?id=<?= $item['id'] ?>">لایک</a></span>
                <small><?= $item['created_at'] ?></small>
            </div>
        <?php endforeach; ?>
    </main>
</body>
</html>