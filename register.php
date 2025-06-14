<?php
require 'init.php';
require 'config/db.php';
require 'classes/User.php';

$db = (new Database())->getConnection();
$user = new User($db);

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($user->register($username, $email, $password)) {
        $success = true;
    } else {
        $error = 'Kayıt başarısız oldu. Kullanıcı adı veya e-posta daha önce kullanılmış olabilir.';
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Ol - Scout Portalı</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('assets/bg.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-box {
            background-color: rgba(0, 0, 0, 0.75);
            padding: 40px;
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
        }
        .register-box h2 {
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
    </style>
</head>
<body>
    <div class="register-box">
        <h2>Kayıt Ol</h2>

        <?php if ($success): ?>
            <div class="alert alert-success text-center">
                Kayıt başarılı! <a href="login.php" class="alert-link text-light">Giriş yap</a>
            </div>
        <?php elseif (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Kullanıcı Adı</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">E-posta</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Şifre</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Kayıt Ol</button>
        </form>

        <div class="text-center mt-3">
            <a href="login.php" class="text-light">Zaten hesabın var mı? Giriş yap</a>
        </div>
    </div>
</body>
</html>
