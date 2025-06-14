<?php
session_start();
require 'config/db.php';
require 'classes/Player.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$db = (new Database())->getConnection();
$player = new Player($db);
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $birth_date = $_POST['birth_date'] ?? '';
    $position = $_POST['position'] ?? '';
    $height = $_POST['height'] ?? 0;
    $weight = $_POST['weight'] ?? 0;
    $salary = $_POST['salary'] ?? '';
    $transfer_fee = $_POST['transfer_fee'] ?? '';
    $active_club = $_POST['active_club'] ?? '';

    if ($player->createPlayer($userId, $name, $surname, $birth_date, $position, $height, $weight, $salary, $transfer_fee, $active_club)) {
        header('Location: player_list.php');
        exit;
    } else {
        $error = "Futbolcu eklenirken hata oluştu.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Futbolcu Ekle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #2c3e50, #4ca1af);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #f8f9fa;
        }
        .form-card {
            background-color: #ffffff;
            color: #212529;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            max-width: 600px;
            margin: auto;
        }
        .form-control {
            border-radius: 0.5rem;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
        }
        .form-title {
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">

    <div class="form-card">
        <h3 class="form-title text-center">Yeni Futbolcu Ekle</h3>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="player_create.php">
            <div class="mb-3">
                <input type="text" name="name" placeholder="Ad" required class="form-control" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <input type="text" name="surname" placeholder="Soyad" required class="form-control" value="<?= htmlspecialchars($_POST['surname'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <input type="date" name="birth_date" required class="form-control" value="<?= htmlspecialchars($_POST['birth_date'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <input type="text" name="position" placeholder="Pozisyon" required class="form-control" value="<?= htmlspecialchars($_POST['position'] ?? '') ?>">
            </div>
            <div class="mb-3">
             <input type="number" step="0.01" name="height" placeholder="Boy (m)" required class="form-control" value="<?= htmlspecialchars($_POST['height'] ?? '') ?>">
            </div>
      <div class="mb-3">
                <input type="number" step="0.01" name="weight" placeholder="Kilo (kg)" required class="form-control" value="<?= htmlspecialchars($_POST['weight'] ?? '') ?>">
            </div>
            <div class="mb-3">
     <input type="text" name="salary" placeholder="Maaş" required class="form-control" value="<?= htmlspecialchars($_POST['salary'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <input type="text" name="transfer_fee" placeholder="Bonservis" required class="form-control" value="<?= htmlspecialchars($_POST['transfer_fee'] ?? '') ?>">
            </div>
            <div class="mb-4">
                <input type="text" name="active_club" placeholder="Aktif Kulüp" required class="form-control" value="<?= htmlspecialchars($_POST['active_club'] ?? '') ?>">
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary px-4">Ekle</button>
                <a href="player_list.php" class="btn btn-secondary px-4">Geri</a>
            </div>
        </form>
    </div>

</body>
</html>
