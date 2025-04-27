<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'mahan') {
    header("Location: index.php");
    exit;
}

include 'db.php';

// انتخاب تمام خبرها
$stmt = $pdo->query("SELECT * FROM news ORDER BY id DESC");
$news = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   
<?php
include 'header.php';
?>

    <main class="col-12 col-md-12 mx-auto">
        <h1 class="col-12 col-md-12 mx-auto">پنل مدیریت</h1>

        <!-- فرم افزودن خبر -->
        <form action="add_news.php" class="col-12 col-md-12 mx-auto" method="POST" enctype="multipart/form-data">
            <input class="col-12 col-md-12 mx-auto" type="text" name="source" placeholder="به نقل از:" required>
            <input class="col-12 col-md-12 mx-auto" type="text" name="agency" placeholder="خبرگزاری:" required>
            <input class="col-12 col-md-12 mx-auto" type="text" name="title" placeholder="عنوان خبر:" required>
            <textarea class="col-12 col-md-12 mx-auto" name="content" placeholder="متن خبر:" required></textarea>
            <input class="col-12 col-md-12 mx-auto" type="file" name="image" accept="image/*" required>
            <button class="col-12 col-md-12 mx-auto" type="submit">+ افزودن خبر</button>
        </form>

        <!-- لیست خبرها -->
        <h2>اخبار موجود</h2>
        <?php foreach ($news as $item): ?>
            <div class="news-item" class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 bg-danger text-white p-3 m-1"> >
                <p><strong>به نقل از:</strong> <?= htmlspecialchars($item['source']) ?></p>
                <p><strong>خبرگزاری:</strong> <?= htmlspecialchars($item['agency']) ?></p>
                <h3><?= htmlspecialchars($item['title']) ?></h3>
                <p><?= htmlspecialchars($item['content']) ?></p>
                <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['title']) ?>">
                <div class="actions">
                    <a  href="delete_news.php?id=<?= $item['id'] ?>" class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">- حذف</a>
                    <a href="edit_news.php?id=<?= $item['id'] ?>" >* ویرایش</a>
                </div>
            </div>
        <?php endforeach; ?>
    </main>
</body>
</html>