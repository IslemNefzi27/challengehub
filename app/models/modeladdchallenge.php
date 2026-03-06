<?php
class challange {
    private $db;

    public function __construct($connexion) {
        $this->db = $connexion;
    }

    public function ajouter( $id_user,$titre,$cat, $desc, $dat) {
        $datf = date('Y-m-d', strtotime($dat));
            $sql = "INSERT INTO challenges (id_user, title, description, category, deadline) VALUES (?, ?, ?, ?, ?)";
            
            $res = $this->db->prepare($sql);
            return $res->execute([
                $id_user, 
                $titre,   
                $desc,   
                $cat,    
                $dat      
            ]);
        }
    
    public function afficher_challenge() {
        $rqt2 = $this->db->query("SELECT * FROM challenges ORDER BY id_ch DESC");
        return $rqt2->fetchAll(PDO::FETCH_ASSOC);
    }

    public function afficher_challenge_supp($id_user) {
        $rqt2 = $this->db->prepare("SELECT * FROM challenges WHERE id_user = ?");
        $rqt2->execute([$id_user]);
        return $rqt2->fetchAll(PDO::FETCH_ASSOC);
    }
    public function supprimer($id_ch, $id_user) {
        $rqt = "DELETE FROM challenges WHERE id_ch = ? AND id_user = ?";
        $res = $this->db->prepare($rqt);
        return $res->execute([$id_ch, $id_user]);
    }

    public function getById($id) {
        $rqt = "SELECT * FROM challenges WHERE id_ch = ?";
        $res = $this->db->prepare($rqt);
        $res->execute([$id]);
        return $res->fetch(PDO::FETCH_ASSOC);
    }

    public function modifier($id, $titre, $desc, $cat, $dat) {
        $rqt = "UPDATE challenges SET title = ?, description = ?, category = ?, deadline = ? WHERE id_ch = ?";
        $res = $this->db->prepare($rqt);
        return $res->execute([$titre, $desc, $cat, $dat, $id]);
    }
    public function getRanking() {
        $sql = "SELECT 
                    s.id_sub, 
                    s.description, 
                    u.nom_utilisateur, 
                    COUNT(v.id_vote) as total_votes
                FROM submissions s
                JOIN user u ON s.id_user = u.id_user
                LEFT JOIN votes v ON s.id_sub = v.id_s
                GROUP BY s.id_sub
                ORDER BY total_votes DESC";
    
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ajouterVote($id_ch, $id_user) {
        $check = $this->db->prepare("SELECT * FROM votes WHERE id_ch = ? AND id_user = ?");
        $check->execute([$id_ch, $id_user]);
        
        if ($check->rowCount() == 0) {
            $stmt = $this->db->prepare("INSERT INTO votes (id_ch, id_user) VALUES (:id_ch, :id_user)");
            return $stmt->execute([$id_ch, $id_user]);
        }
        return false;
    }
}