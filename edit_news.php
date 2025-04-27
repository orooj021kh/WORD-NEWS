<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'mahan') {
    header("Location: index.php");
    exit;
}

include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // انتخاب خبر مورد نظر
    $stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
    $stmt->execute([$id]);
    $news = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>



<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش خبر</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include 'header.php';
?>

    <main class="col-12 col-md-12 mx-auto">
        <h1>ویرایش خبر</h1>

        <form action="update_news.php" method="POST" enctype="multipart/form-data">
            <input class="col-12 col-md-12 mx-auto" type="hidden" name="id" value="<?= $news['id'] ?>">
            <input class="col-12 col-md-12 mx-auto" type="text" name="source" placeholder="به نقل از:" value="<?= htmlspecialchars($news['source']) ?>" required>
            <input class="col-12 col-md-12 mx-auto" type="text" name="agency" placeholder="خبرگزاری:" value="<?= htmlspecialchars($news['agency']) ?>" required>
            <input class="col-12 col-md-12 mx-auto" type="text" name="title" placeholder="عنوان خبر:" value="<?= htmlspecialchars($news['title']) ?>" required>
            <textarea class="col-12 col-md-12 mx-auto" name="content" placeholder="متن خبر:" required><?= htmlspecialchars($news['content']) ?></textarea>
            <input class="col-12 col-md-12 mx-auto" type="file" name="image" accept="image/*">
            <button class="col-12 col-md-12 mx-auto" type="submit">ثبت تغییرات</button>
        </form>
    </main>
</body>
</html>