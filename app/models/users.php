<?php
class User {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function creation($username, $email, $hashedPassword) {
  
        $sql = "INSERT INTO user (nom_utilisateur, email_utilisateur, mot_passe) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$username, $email, $hashedPassword]);
    }


    public function login($email, $password) {
        $sql = "SELECT * FROM user WHERE email_utilisateur = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

     
        if ($user && password_verify($password, $user['mot_passe'])) {
            return $user; 
        }
        
        return false;
    }

    
    public function updateProfile($userId, $username, $email) {
        $sql = "UPDATE user SET nom_utilisateur = ?, email_utilisateur = ? WHERE id_user = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$username, $email, $userId]);
    }
}
?>