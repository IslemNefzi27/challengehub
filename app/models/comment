<?php
class Comment {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // Ajouter un commentaire
    public function addComment($id_s, $id_user, $content) {
        $sql = "INSERT INTO comment (id_s, id_user, content) VALUES (:id_s, :id_user, :content)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id_s' => $id_s,
            ':id_user' => $id_user,
            ':content' => htmlspecialchars($content) // Protection XSS
        ]);
    }
public function getCommentsBySubmission($id_s) {
    $sql = "SELECT c.*, u.nom_utilisateur 
            FROM comment c 
            JOIN user u ON c.id_user = u.id_user 
            WHERE c.id_s = :id_s 
            ORDER BY c.id_comm DESC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([':id_s' => $id_s]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
