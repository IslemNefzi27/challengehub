<?php
if (!class_exists('Comment')) {
    class Comment {
        private $db;

        public function __construct($database) {
            $this->db = $database;
        }

        public function getCommentsByChallenge($id_s) {
            $sql = "SELECT c.*, u.nom_utilisateur, c.id_user AS owner_id 
                    FROM comment c 
                    LEFT JOIN user u ON c.id_user = u.id_user 
                    WHERE c.id_s = :id_s 
                    ORDER BY c.id_comm DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id_s' => $id_s]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addComment($id_s, $id_user, $content) {
            $sql = "INSERT INTO comment (id_s, id_user, content) VALUES (:id_s, :id_user, :content)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':id_s' => $id_s,
                ':id_user' => $id_user,
                ':content' => htmlspecialchars($content)
            ]);
        }

        // Modifier un commentaire existant
        public function updateComment($id_comm, $id_user, $new_content) {
            $sql = "UPDATE comment 
                    SET content = :content 
                    WHERE id_comm = :id_comm AND id_user = :id_user";
            
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':id_comm' => $id_comm,
                ':id_user' => $id_user,
                ':content' => htmlspecialchars($new_content)
            ]);
        }
        //.......
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
        // Supprimer un commentaire
        public function deleteComment($id_comm, $id_user) {
            $sql = "DELETE FROM comment WHERE id_comm = :id_comm AND id_user = :id_user";
            
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':id_comm' => $id_comm,
                ':id_user' => $id_user
            ]);
        }
    } 
    
}
?>