<?php
session_start();
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
    <title>صفحه خانه</title>
    <link rel="stylesheet" href="   style.css">
</head>
<body>

<?php
include 'header.php';
?>

    <main>
        <h1 class="col-12 col-md-12 mx-auto">اخبار</h1>
        <?php foreach ($news as $item): ?>
            <div class="news-item" class="col-12 col-md-12 mx-auto">
                <p class="col-12 col-md-12 mx-auto"><strong>به نقل از:</strong> <?= htmlspecialchars($item['source']) ?></p>
                <p class="col-12 col-md-12 mx-auto"><strong>خبرگزاری:</strong> <?= htmlspecialchars($item['agency']) ?></p>
                <h2><?= htmlspecialchars($item['title']) ?></h2>
                <p><?= htmlspecialchars($item['content']) ?></p>
                <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['title']) ?>">
            </div>
        <?php endforeach; ?>
    </main>
</body>
</html> 