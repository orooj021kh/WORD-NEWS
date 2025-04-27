<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);
        echo "<script>alert('ثبت نام با موفقیت انجام شد!'); window.location.href='login.php';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('خطا: این نام کاربری یا ایمیل قبلاً استفاده شده است.'); window.location.href='register.php';</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<?php
include 'header.php';
?>

    <main class="col-12 col-md-12 mx-auto">
        <h1 class="col-12 col-md-12 mx-auto">ثبت نام</h1>
        <form method="POST" class="col-12 col-md-12 mx-auto">
            <input class="col-12 col-md-12 mx-auto" type="text" name="username" placeholder="نام کاربری" required>
            <input class="col-12 col-md-12 mx-auto" type="email" name="email" placeholder="ایمیل" required>
            <input class="col-12 col-md-12 mx-auto" type="password" name="password" placeholder="رمز عبور" required>
            <button class="col-12 col-md-12 mx-auto" type="submit">ثبت نام</button>
        </form>
    </main>
</body>
</html>