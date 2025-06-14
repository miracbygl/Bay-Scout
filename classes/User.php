<?php

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Kullanıcı kaydı (register)
    public function register($username, $email, $password) {
        // Aynı kullanıcı adı veya e-posta var mı kontrol et
        $checkSql = "SELECT id FROM users WHERE username = :username OR email = :email";
        $checkStmt = $this->conn->prepare($checkSql);
        $checkStmt->execute([
            ':username' => $username,
            ':email' => $email
        ]);

        if ($checkStmt->rowCount() > 0) {
            return false; // Kayıt başarısız, kullanıcı adı veya e-posta zaten var
        }

        // Şifreyi hash'le
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Kullanıcıyı kaydet
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword
        ]);
    }

    // Giriş işlemi
    public function loginUser($usernameOrEmail, $password) {
        $sql = "SELECT * FROM users WHERE username = :ue OR email = :ue";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':ue' => $usernameOrEmail]);

        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                return true;
            }
        }

        return false;
    }

    // Oturum kontrolü
    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    // Oturumu kapat
    public function logout() {
        session_unset();
        session_destroy();
    }

    // Kullanıcı bilgilerini getir
    public function getUserById($id) {
        $sql = "SELECT id, username, email FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Kullanıcı bilgilerini güncelle
    public function updateUser($id, $username, $email) {
        $sql = "UPDATE users SET username = :username, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':id' => $id
        ]);
    }

    // Kullanıcıyı sil
    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
