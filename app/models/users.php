<?php
// Définition d'une classe 
class User {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // Méthode pour l'inscription (p.37 Formulaires)
    public function register($username, $email, $password) {
        // Hachage du mot de passe (Cahier des charges 3.A)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$username, $email, $hashedPassword]);
    }

    // Méthode pour la connexion 
    public function login($email, $password) {
        // Recherche de l'utilisateur par email
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification du mot de passe
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Retourne les données de l'utilisateur
        }
        
        return false; // Identifiants incorrects
    }

    // Méthode pour modifier le profil 
    public function updateProfile($userId, $username, $email) {
        $sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$username, $email, $userId]);
    }
}
?>