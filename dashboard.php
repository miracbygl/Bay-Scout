<?php
session_start();
require 'config/db.php';
require 'classes/User.php';
require 'classes/Player.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$db = (new Database())->getConnection();

$userClass = new User($db);


$playerClass = new Player($db);

$user = $userClass->getUserById($_SESSION['user_id']);


$playerCount = $playerClass->countPlayersByUser($_SESSION['user_id']);
$recentPlayers = $playerClass->getRecentPlayersByUser($_SESSION['user_id'], 5);
?>

<!DOCTYPE html>
<html lang="tr">
<head>


    <meta charset="UTF-8">


    <title>Scouter Paneli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>


        body {
            background: url('assets/bg.jpg') no-repeat center center fixed;
         background-size: cover;


            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #f8f9fa;

            min-height: 100vh;
        }

        .dashboard-wrapper {
            background-color: rgba(0, 0, 0, 0.75);


            min-height: 100vh;


            padding: 40px 20px;
        }

        .dashboard-header {


            background-color: rgba(255,255,255,0.05);

            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 2rem;
        }

        .dashboard-header h2 {
            color: #ffffff;
        }

        .btn-outline-light,

        .btn-outline-info,


        .btn-outline-danger {

            border-radius: 20px;
        }

        .card-metric {
            border: none;


            border-radius: 1rem;


            background: #ffffff;


            color: #212529;
            
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .list-group-item {
            background-color: #ffffff;
            border: none;
            border-radius: 0.75rem;
            margin-bottom: 10px;
            box-shadow: 0 1px 6px rgba(0,0,0,0.1);
        }

        .list-group-item:hover {
            background-color: #f1f1f1;
        }

        .section-title {
            border-bottom: 2px solid #ffffff88;
            padding-bottom: 5px;
            margin-bottom: 15px;
            font-size: 1.25rem;
        }
    </style>
</head>
<body>

<div class="dashboard-wrapper">
    <div class="container">
    <div class="dashboard-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
<h2 class="mb-3">Hoşgeldiniz, <?= htmlspecialchars($user['username']) ?> </h2>
                <div>
<a href="player_create.php" class="btn btn-outline-light me-2">+ Futbolcu Ekle</a>
 <a href="player_list.php" class="btn btn-outline-info me-2">Futbolcu Listesi</a>
<a href="logout.php" class="btn btn-outline-danger">Çıkış Yap</a>
 </div>
 </div>
 </div>
 <div class="row mb-4">
 <div class="col-md-4">
 <div class="card card-metric text-center">
 <div class="card-body">
 <h5 class="card-title">Toplam Futbolcu</h5>
 <p class="display-4 fw-bold text-primary"><?= $playerCount ?></p>
 </div>
</div>
           


</div>
        

</div>

        <h4 class="section-title text-white">📋 Son Eklenen Futbolcular</h4>
    <?php if (count($recentPlayers) > 0): ?>
     <div class="list-group">
     <?php foreach ($recentPlayers as $player): ?>
     <div class="list-group-item d-flex justify-content-between align-items-center">
     <div>
     <strong><?= htmlspecialchars($player['name'] . ' ' . $player['surname']) ?></strong>
 <span class="text-muted"> - <?= htmlspecialchars($player['position']) ?></span>
     </div>
       <a href="player_edit.php?id=<?= $player['id'] ?>" class="btn btn-sm btn-outline-secondary">Düzenle</a>
     </div>
    <?php endforeach; ?>
     </div>
<?php else: ?>
 <div class="alert alert-warning bg-light text-dark">Henüz futbolcu eklemediniz.</div>
 <?php endif; ?>
    </div>
</div>

</body>
</html>
