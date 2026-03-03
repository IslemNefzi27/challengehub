<?php
class Database {
    private $host = "localhost";
    private $db_name = "challengehub"; 
    private $username = "root";
    private $password = "";
    private $conn;
    private static $instance = null;

    // Le constructeur est privé pour empêcher l'instanciation directe
    private function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
        } catch(PDOException $exception) {
            die("Erreur de connexion : " . $exception->getMessage());
        }
    }

    // Méthode statique pour récupérer l'unique instance de la connexion
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
}