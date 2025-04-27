<?php
session_start();
include 'db.php';

if (!isset($_GET['news_id'])) {
    header("Location: index.php");
    exit;
}

$news_id = $_GET['news_id'];

// انتخاب خبر
$stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
$stmt->execute([$news_id]);
$news = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$news) {
    echo "<script>alert('خبر مورد نظر یافت نشد.'); window.location.href='index.php';</script>";
    exit;
}

// انتخاب نظرات مرتبط با این خبر
$stmt = $pdo->prepare("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE comments.news_id = ? ORDER BY created_at DESC");
$stmt->execute([$news_id]);
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ثبت نظر جدید
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    if (!isset($_SESSION['user'])) {
        echo "<script>alert('برای ثبت نظر باید وارد شوید.'); window.location.href='login.php';</script>";
        exit;
    }

    $user_id = $_SESSION['user']['id'];
    $comment = $_POST['comment'];

    $stmt = $pdo->prepare("INSERT INTO comments (user_id, news_id, comment) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $news_id, $comment]);

    header("Location: view_comments.php?news_id=$news_id");
    exit;
}
?>


<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظرات - <?= htmlspecialchars($news['title']) ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include 'header.php';
?>

    <main>
        <h1 class="col-12 col-md-12 mx-auto">نظرات - <?= htmlspecialchars($news['title']) ?></h1>

        <!-- فرم ثبت نظر -->
        <form method="POST" class="col-12 col-md-12 mx-auto">
            <textarea class="col-12 col-md-12 mx-auto" name="comment" placeholder="نظر خود را بنویسید..." required></textarea>
            <button class="col-12 col-md-12 mx-auto" type="submit">ثبت نظر</button>
        </form>

        <!-- لیست نظرات -->
        <h2 class="col-12 col-md-12 mx-auto">نظرات:</h2>
        <?php if (empty($comments)): ?>
            <p class="col-12 col-md-12 mx-auto">هنوز نظری ثبت نشده است.</p>
        <?php else: ?>
            <?php foreach ($comments as $item): ?>
                <div class="comment-item" class="col-12 col-md-12 mx-auto">
                    <p class="col-12 col-md-12 mx-auto"><strong><?= htmlspecialchars($item['username']) ?>:</strong> <?= htmlspecialchars($item['comment']) ?></p>
                    <small><?= $item['created_at'] ?></small>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>
</body>
</html>