<?php
require 'init.php';
require 'config/db.php';
require 'classes/Player.php';

$db = (new Database())->getConnection();
$player = new Player($db);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $data = $player->getPlayerById($id);

    if ($data && $data['user_id'] == $_SESSION['user_id']) {
        $player->deletePlayer($id);
    }
}

header("Location: player_list.php");
exit();
