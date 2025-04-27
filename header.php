<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منوی ناوبری</title>
    <!-- لینک فایل CSS بوت‌استرپ -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- استایل اختصاصی (در صورت نیاز) -->
    <style>
        /* تنظیمات اختصاصی برای هدر */
        header {
            padding: 10px 0;
        }
        nav {
            background-color: #9F5255 !important; /* رنگ پس‌زمینه قرمز متمایل به بنفش */
        }
        nav a {
            color: black !important; /* رنگ متن مشکی */
            margin-left: 10px;
        }
        nav a:hover {
            text-decoration: none;
            color: darkgray !important; /* رنگ متن هاور خاکستری تیره */
        }
    </style>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <!-- برند یا لوگو -->
            <a class="navbar-brand" href="index.php">خانه</a>

            <!-- دکمه منوی تلفن همراه -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- محتوای منو -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="comments.php">نظرات عمومی</a>
                    </li>
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">خروج</a>
                        </li>
                        <?php if ($_SESSION['user']['username'] === 'mahan'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="admin.php">پنل مدیریت</a>
                            </li>
                        <?php endif; ?>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">ورود</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">ثبت نام</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- جاوااسکریپت بوت‌استرپ -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>