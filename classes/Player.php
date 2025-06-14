<?php

class Player {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Yeni futbolcu ekle
    public function createPlayer($user_id, $name, $surname, $birth_date, $position, $height, $weight, $salary, $transfer_fee, $active_club) {
        $sql = "INSERT INTO players (user_id, name, surname, birth_date, position, height, weight, salary, transfer_fee, active_club) 
                VALUES (:user_id, :name, :surname, :birth_date, :position, :height, :weight, :salary, :transfer_fee, :active_club)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':user_id' => $user_id,
            ':name' => $name,
            ':surname' => $surname,
            ':birth_date' => $birth_date,
            ':position' => $position,
            ':height' => $height,
            ':weight' => $weight,
            ':salary' => $salary,
            ':transfer_fee' => $transfer_fee,
            ':active_club' => $active_club
        ]);
    }

    // Kullanıcının futbolcularını getir
    public function getPlayersByUser($user_id) {
        $sql = "SELECT * FROM players WHERE user_id = :user_id ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Belirli bir futbolcuyu getir
    public function getPlayerById($player_id) {
        $sql = "SELECT * FROM players WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $player_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Futbolcu bilgilerini güncelle
    public function updatePlayer($player_id, $name, $surname, $birth_date, $position, $height, $weight, $salary, $transfer_fee, $active_club) {
        $sql = "UPDATE players SET name = :name, surname = :surname, birth_date = :birth_date, 
                position = :position, height = :height, weight = :weight,
                salary = :salary, transfer_fee = :transfer_fee, active_club = :active_club
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':surname' => $surname,
            ':birth_date' => $birth_date,
            ':position' => $position,
            ':height' => $height,
            ':weight' => $weight,
            ':salary' => $salary,
            ':transfer_fee' => $transfer_fee,
            ':active_club' => $active_club,
            ':id' => $player_id
        ]);
    }

    // Futbolcuyu sil
    public function deletePlayer($player_id) {
        $sql = "DELETE FROM players WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $player_id]);
    }

    // Kullanıcının futbolcu sayısını getir
    public function countPlayersByUser($user_id) {
        $sql = "SELECT COUNT(*) as total FROM players WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    // Kullanıcının son eklediği futbolcuları getir (ID dahil!)
    public function getRecentPlayersByUser($user_id, $limit = 5) {
        $sql = "SELECT id, name, surname, position FROM players WHERE user_id = :user_id ORDER BY id DESC LIMIT :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
