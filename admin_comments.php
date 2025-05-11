<?php
session_start();
include 'db.php';

// فقط mahan میتونه وارد بشه
if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'mahan') {
    header("Location: index.php");
    exit;
}

// حذف نظر
if (isset($_GET['delete'])) {
    $comment_id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM comments WHERE id = ?")->execute([$comment_id]);
    header("Location: admin_comments.php");
    exit;
}

// ویرایش نظر
$edit_comment = null;
if (isset($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM comments WHERE id = ?");
    $stmt->execute([$edit_id]);
    $edit_comment = $stmt->fetch(PDO::FETCH_ASSOC);
}

// ذخیره نظر ویرایش شده
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_edit'])) {
    $id = (int)$_POST['id'];
    $new_comment = $_POST['edited_comment'];
    $pdo->prepare("UPDATE comments SET comment = ? WHERE id = ?")->execute([$new_comment, $id]);
    header("Location: admin_comments.php");
    exit;
}

// ثبت نظر ادمین به عنوان نظر پین‌شده
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pin_comment'])) {
    $user_id = $_SESSION['user']['id'];
    $comment = $_POST['pinned_comment'];

    // حذف نظر قبلی اگر وجود داشته باشه
    $pdo->exec("DELETE FROM pinned_comments WHERE user_id = $user_id");

    // ذخیره نظر جدید
    $pdo->prepare("INSERT INTO pinned_comments (user_id, comment) VALUES (?, ?)")->execute([$user_id, $comment]);

    header("Location: admin_comments.php");
    exit;
}

// دریافت تمام نظرات
$stmt = $pdo->query("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id ORDER BY created_at DESC");
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// دریافت نظر پین‌شده ادمین
$pinned_stmt = $pdo->query("SELECT pinned_comments.*, users.username FROM pinned_comments JOIN users ON pinned_comments.user_id = users.id LIMIT 1");
$pinned_comment = $pinned_stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مدیریت نظرات</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'header.php'; ?>

<main class="col-12 col-md-6 mx-auto">

    <h1>پنل مدیریت نظرات</h1>

    <!-- فرم ثبت نظر پین‌شده -->
    <form method="POST" class="mb-4">
        <textarea name="pinned_comment" placeholder="نظر پین‌شده شما..." required><?= $pinned_comment['comment'] ?? '' ?></textarea>
        <button type="submit" name="pin_comment">ثبت نظر پین‌شده</button>
    </form>

    <!-- نمایش نظر پین‌شده -->
    <?php if ($pinned_comment): ?>
        <div style="background:#fffdd0; border-left:5px solid gold; padding:10px; margin-bottom:20px;">
            <strong><?= htmlspecialchars($pinned_comment['username']) ?> (پین شده)</strong><br>
            <?= htmlspecialchars($pinned_comment['comment']) ?><br>
            <small><?= $pinned_comment['created_at'] ?></small>
        </div>
    <?php endif; ?>

    <!-- لیست نظرات -->
    <h2>همه نظرات:</h2>
    <?php foreach ($comments as $item): ?>
        <div class="comment-item">
            <p><strong><?= htmlspecialchars($item['username']) ?>:</strong> <?= htmlspecialchars($item['comment']) ?></p>
            <small><?= $item['created_at'] ?></small>
            <div class="actions">
                <a href="?edit=<?= $item['id'] ?>">ویرایش</a> |
                <a href="?delete=<?= $item['id'] ?>" onclick="return confirm('آیا مطمئن هستید؟')">حذف</a>
            </div>

            <!-- فرم ویرایش -->
            <?php if ($edit_comment && $edit_comment['id'] == $item['id']): ?>
                <form method="POST" style="margin-top:10px;">
                    <input type="hidden" name="id" value="<?= $edit_comment['id'] ?>">
                    <textarea name="edited_comment"><?= htmlspecialchars($edit_comment['comment']) ?></textarea>
                    <button type="submit" name="save_edit">ذخیره</button>
                </form>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</main>

</body>
</html>