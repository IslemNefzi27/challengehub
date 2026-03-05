<?php
class Vote {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function ajouter($titre, $description, $categorie, $date) {
        $sql = "INSERT INTO challenges (title, description, category, deadline) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$titre, $description, $categorie, $date]);
    }


    public function afficher_challenge() {
        $sql = "SELECT * FROM challenges ORDER BY id_ch DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addVote($userId, $submissionId) {
        $sql_verif = "SELECT * FROM votes WHERE id_user = ? AND id_s = ?";
        $stmt_verif = $this->db->prepare($sql_verif);
        $stmt_verif->execute([$userId, $submissionId]);

        if ($stmt_verif->rowCount() == 0) {
            $sql = "INSERT INTO votes (id_user, id_s) VALUES (?, ?)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$userId, $submissionId]);
        }
        return false; 
    }

    public function getRanking() {
        $sql = "SELECT s.id_sub , s.description, u.nom_utilisateur, COUNT(v.id_s) as total_votes 
                FROM submissions s
                LEFT JOIN votes v ON s.id_sub = v.id_s
                JOIN user u ON s.id_user = u.id_user
                GROUP BY s.id_sub
                ORDER BY total_votes DESC";

        $res = $this->db->query($sql);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>