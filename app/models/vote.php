<?php
// La Programmation Orienté Objet (POO)
class Vote {
    // Variable d'instance
    private $db;

    // Constructeur pour recevoir la connexion PDO 
    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // Méthode pour ajouter un vote (1 vote par utilisateur / participation)
    public function addVote($userId, $submissionId) {
        // Vérification si le vote existe déjà (PDO rowCount)
        $sql_verif = "SELECT * FROM votes WHERE user_id = ? AND submission_id = ?";
        $stmt_verif = $this->db->prepare($sql_verif);
        $stmt_verif->execute([$userId, $submissionId]);

        // Si l'utilisateur n'a pas encore voté 
        if ($stmt_verif->rowCount() == 0) {
            $sql = "INSERT INTO votes (user_id, submission_id) VALUES (?, ?)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$userId, $submissionId]);
        }
        
        return false; // Déjà voté
    }

    // Méthode pour récupérer le classement (Ranking)
    public function getRanking() {
        // Requête avec jointure et groupement 
        $sql = "SELECT s.id as sub_id, s.description, u.username, COUNT(v.submission_id) as total_votes 
                FROM submissions s
                LEFT JOIN votes v ON s.id = v.submission_id
                JOIN users u ON s.user_id = u.id
                GROUP BY s.id 
                ORDER BY total_votes DESC";

        $res = $this->db->query($sql);
        
        // Retourne un résultat sous forme de tableau associatif 
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>