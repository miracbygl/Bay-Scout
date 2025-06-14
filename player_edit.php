<?php
session_start();
require 'config/db.php';
require 'classes/Player.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: player_list.php');
    exit;
}

$db = (new Database())->getConnection();
$player = new Player($db);

$id = (int)$_GET['id'];
$error = '';

$existingPlayer = $player->getPlayerById($id);

if (!$existingPlayer || $existingPlayer['user_id'] != $_SESSION['user_id']) {
    header('Location: player_list.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $birth_date = $_POST['birth_date'] ?? '';
    $position = $_POST['position'] ?? '';
    $height = $_POST['height'] ?? 0;
    $weight = $_POST['weight'] ?? 0;
    $salary = $_POST['salary'] ?? '';
    $transfer_fee = $_POST['transfer_fee'] ?? '';
    $active_club = $_POST['active_club'] ?? '';

    if ($player->updatePlayer($id, $name, $surname, $birth_date, $position, $height, $weight, $salary, $transfer_fee, $active_club)) {
        header('Location: player_list.php');
        exit;
    } else {
        $error = "Güncelleme sırasında hata oluştu.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Futbolcu Düzenle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('assets/bg.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            min-height: 100vh;
        }
        .container-box {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 30px;
            margin-top: 50px;
            border-radius: 12px;
            max-width: 700px;
        }
        .form-control {
            background-color: #222;
            color: #fff;
            border: 1px solid #444;
        }
        .form-control::placeholder {
            color: #bbb;
        }
        .btn {
            min-width: 100px;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="container-box">
            <h2 class="mb-4">Futbolcu Düzenle</h2>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="player_edit.php?id=<?= $id ?>">
                <input type="text" name="name" placeholder="Ad" required class="form-control mb-3" value="<?= htmlspecialchars($_POST['name'] ?? $existingPlayer['name']) ?>">
                <input type="text" name="surname" placeholder="Soyad" required class="form-control mb-3" value="<?= htmlspecialchars($_POST['surname'] ?? $existingPlayer['surname']) ?>">
                <input type="date" name="birth_date" required class="form-control mb-3" value="<?= htmlspecialchars($_POST['birth_date'] ?? $existingPlayer['birth_date']) ?>">
                <input type="text" name="position" placeholder="Pozisyon" required class="form-control mb-3" value="<?= htmlspecialchars($_POST['position'] ?? $existingPlayer['position']) ?>">
                <input type="number" step="0.01" name="height" placeholder="Boy (m)" required class="form-control mb-3" value="<?= htmlspecialchars($_POST['height'] ?? $existingPlayer['height']) ?>">
                <input type="number" step="0.01" name="weight" placeholder="Kilo (kg)" required class="form-control mb-3" value="<?= htmlspecialchars($_POST['weight'] ?? $existingPlayer['weight']) ?>">
                <input type="text" name="salary" placeholder="Maaş" required class="form-control mb-3" value="<?= htmlspecialchars($_POST['salary'] ?? $existingPlayer['salary']) ?>">
                <input type="text" name="transfer_fee" placeholder="Bonservis" required class="form-control mb-3" value="<?= htmlspecialchars($_POST['transfer_fee'] ?? $existingPlayer['transfer_fee']) ?>">
                <input type="text" name="active_club" placeholder="Aktif Kulüp" required class="form-control mb-3" value="<?= htmlspecialchars($_POST['active_club'] ?? $existingPlayer['active_club']) ?>">

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Güncelle</button>
                    <a href="player_list.php" class="btn btn-secondary">Geri</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
