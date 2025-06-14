<?php

class Login {
    private $conn;
    private $table = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function loginUser($usernameOrEmail, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :input OR email = :input LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":input", $usernameOrEmail);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                return true;
            }
        }

        return false;
    }
}
