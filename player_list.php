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

$userId = $_SESSION['user_id'];
$players = $player->getPlayersByUser($userId);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Futbolcu Listesi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('assets/bg1.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            color: white;
        }
        .container-box {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 30px;
            margin-top: 50px;
            border-radius: 12px;
        }
        h2 {
            color: #f8f9fa;
            text-align: center;
            margin-bottom: 30px;
        }
        .btn {
            margin: 3px;
        }
        .table {
            color: white;
            border-color: #555;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table thead {
            background-color: #343a40;
        }
        .alert-info {
            background-color: rgba(13, 110, 253, 0.1);
            color: #d1e9ff;
            border: 1px solid #0d6efd;
        }
    </style>
</head>
<body>
    <div class="container container-box">
        <h2>Futbolcu Listesi</h2>

        <div class="d-flex justify-content-between mb-3">
            <a href="player_create.php" class="btn btn-success">Yeni Futbolcu Ekle</a>
            <a href="dashboard.php" class="btn btn-secondary">Dashboard'a Dön</a>
        </div>

        <?php if (empty($players)): ?>
            <div class="alert alert-info">Henüz futbolcu eklemediniz.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Ad</th>
                  <th>Soyad</th>
                            <th>Doğum Tarihi</th>
                       <th>Pozisyon</th>
                            <th>Boy (m)</th>
                            <th>Kilo (kg)</th>
                    <th>Maaş $</th>
                            <th>Bonservis $</th>
                  <th>Aktif Kulüp</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($players as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['name']) ?></td>
                                <td><?= htmlspecialchars($p['surname']) ?></td>
                                <td><?= htmlspecialchars($p['birth_date']) ?></td>
                                <td><?= htmlspecialchars($p['position']) ?></td>
                                <td><?= htmlspecialchars($p['height']) ?></td>
                                <td><?= htmlspecialchars($p['weight']) ?></td>
                                <td><?= htmlspecialchars($p['salary']) ?></td>
                                <td><?= htmlspecialchars($p['transfer_fee']) ?></td>
                                <td><?= htmlspecialchars($p['active_club']) ?></td>
                                <td>
                                    <a href="player_edit.php?id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">Düzenle</a>
                                    <form method="POST" action="player_delete.php" onsubmit="return confirm('Silmek istediğinize emin misiniz?')" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
