<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('نام کاربری یا رمز عبور اشتباه است.');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include 'header.php';
?>

    <main class="col-12 col-md-12 mx-auto">
        <h1 class="col-12 col-md-12 mx-auto">ورود</h1>
        <form method="POST" >
            <input class="col-12 col-md-12 mx-auto" type="text" name="username" placeholder="نام کاربری" required>
            <input class="col-12 col-md-12 mx-auto" type="password" name="password" placeholder="رمز عبور" required>
            <button class="col-12 col-md-12 mx-auto" type="submit">ورود</button>
        </form>
    </main>
</body>
</html>