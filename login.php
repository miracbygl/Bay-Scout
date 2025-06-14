<?php
require 'init.php';
require 'config/db.php';
require 'classes/Login.php';



$db = (new Database())->getConnection();
$login = new Login($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = $_POST['usernameOrEmail'];
    $password = $_POST['password'];

    if ($login->loginUser($usernameOrEmail, $password)) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Geçersiz kullanıcı adı/e-posta veya şifre.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap - Bay Scout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(to right, #141e30, #243b55);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
            color: white;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.05);
            padding: 40px;
            border-radius: 20px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(8px);
        }

        .login-box h2 {
            margin-bottom: 25px;
            text-align: center;
        }

        .form-control {
            background-color: #222;
            border: 1px solid #444;
            color: white;
        }

        .form-control:focus {
            background-color: #222;
            color: white;
            border-color: #0d6efd;
            box-shadow: none;
        }

        .btn-primary {
            width: 100%;
        }

        a {
            color: #ddd;
            text-decoration: none;
        }

        a:hover {
            color: #fff;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Bay Scout Giriş</h2>

        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="usernameOrEmail" class="form-label">Kullanıcı Adı veya E-posta</label>
                <input type="text" name="usernameOrEmail" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Şifre</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Giriş Yap</button>
        </form>

        <div class="text-center mt-3">
            <a href="register.php">Hesabınız yok mu? Kayıt olun</a>
        </div>
    </div>
</body>
</html>
