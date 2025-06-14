<?php

class Database {
    private $host = "localhost";
    private $db_name = "veri_tabanı";
    private $username = "kulanıcıadı";
    private $password = "veritanaışifresi";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name;charset=utf8", 
                                  $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Veritabanı bağlantı hatası: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
