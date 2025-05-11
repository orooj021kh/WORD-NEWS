<?php
session_start();
include 'db.php';

// فقط کاربران لاگین کرده میتونن نظر بذارن
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    if (!isset($_SESSION['user'])) {
        echo "<script>alert('برای ثبت نظر باید وارد شوید.'); window.location.href='login.php';</script>";
        exit;
    }

    $user_id = $_SESSION['user']['id'];
    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);

    if (empty($comment)) {
        echo "<script>alert('نظر نمیتواند خالی باشد.'); window.location.href='comments.php';</script>";
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO comments (user_id, news_id, comment) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $news_id, $comment]);

    header("Location: comments.php");
    exit;
}

// دریافت تمام نظرات عمومی
$stmt = $pdo->query("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id ORDER BY created_at DESC");
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>نظرات عمومی</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'header.php'; ?>

<main class="col-12 col-md-6 mx-auto">
    <h1 class="col-12 col-md-6 mx-auto">نظرات عمومی</h1>

    <!-- فرم ثبت نظر -->
    <form method="POST" class="col-12 col-md-12 mx-auto">
        <input type="hidden" name="news_id" value="<?= isset($_GET['news_id']) ? (int)$_GET['news_id'] : '' ?>">
        <textarea class="col-12 col-md-12 mx-auto" name="comment" placeholder="نظر خود را بنویسید..." required></textarea>
        <button class="col-12 col-md-12 mx-auto" type="submit">ثبت نظر</button>
    </form>

    <!-- لیست نظرات -->
    <h2 class="col-12 col-md-12 mx-auto">نظرات :</h2>
    <?php if (empty($comments)): ?>
        <p class="col-12 col-md-12 mx-auto">هنوز نظری ثبت نشده است.</p>
    <?php else: ?>
        <?php foreach ($comments as $item): ?>
            <div class="comment-item col-12 col-md-12 mx-auto">
                <p><strong><?= htmlspecialchars($item['username']) ?>:</strong> <?= htmlspecialchars($item['comment']) ?></p>
                <small><?= htmlspecialchars($item['created_at']) ?></small>

                <!-- نمایش گزینه‌های مدیریت فقط برای mahan -->
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['username'] === 'mahan'): ?>
                    <div class="actions">
                        <a href="?delete=<?= $item['id'] ?>" onclick="return confirm('آیا مطمئن هستید؟')" style="color: red; margin-left: 10px;">حذف</a>
                        <a href="?edit=<?= $item['id'] ?>" style="color: blue;">ویرایش</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

</body>
</html>

<?php
// عملیات حذف نظر
if (isset($_GET['delete'])) {
    if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'mahan') {
        die("دسترسی غیرمجاز.");
    }

    $comment_id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM comments WHERE id = ?")->execute([$comment_id]);
    header("Location:comments.php");
    exit;
}

// عملیات ویرایش نظر
if (isset($_GET['edit'])) {
    if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'mahan') {
        die("دسترسی غیرمجاز.");
    }

    $edit_id = (int)$_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM comments WHERE id = ?");
    $stmt->execute([$edit_id]);
    $edit_comment = $stmt->fetch(PDO::FETCH_ASSOC);

    // نمایش فرم ویرایش بالای صفحه
    echo '
    <main class="col-12 col-md-6 mx-auto" style="margin-top: 30px;">
        <h2>ویرایش نظر</h2>
        <form method="POST" action="save_edit.php" class="col-12 col-md-12 mx-auto">
            <input type="hidden" name="id" value="' . $edit_comment['id'] . '">
            <textarea class="col-12 col-md-12 mx-auto" name="edited_comment" required>' . htmlspecialchars($edit_comment['comment']) . '</textarea>
            <button class="col-12 col-md-12 mx-auto" type="submit">ذخیره تغییرات</button>
        </form>
    </main>';
}
?>