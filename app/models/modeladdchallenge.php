<?php
    class challange
    {
        private $db;
        //constructure pour connecter base des donnees
        public function __construct($connexion)
        {
            $this->db=$connexion;
        }
        //founction pour ajouter challenge
        public function ajouter($titre,$desc,$cat,$dat)
        {
            $datf= date('Y-m-d', strtotime($dat));
            $rqt1="INSERT INTO challenges (title,category,description,deadline) VALUES (?, ?, ?, ?)";
            $res=$this->db->prepare($rqt1);
            return $res->execute([$titre,$desc,$cat,$datf]);
        }
        //founction pour afficher challenge
        public function afficher_challenge()
        {
            $rqt2=$this->db->query("select * from challenges order by id_ch desc");
            return $rqt2->fetchAll(PDO::FETCH_ASSOC);
        }
        public function afficher_challenge_supp($id_user)
        {
            $rqt2=$this->db->prepare("select * from challenges  where id_user=?");
            return $rqt2->fetchAll(PDO::FETCH_ASSOC);
        }
//supprimer challange
public function supprimer($id_ch,$id_user) {
    $rqt = "DELETE FROM challenges WHERE id_ch = ? and id_user= ?";
    $res = $this->db->prepare($rqt);
    return $res->execute([$id_ch,$id_user]);
}
// return id
public function getById($id) {
    $rqt = "SELECT * FROM challenges WHERE id_ch = ?";
    $res = $this->db->prepare($rqt);
    $res->execute([$id]);
    return $res->fetch(PDO::FETCH_ASSOC);
}

// mettre a jour challange
public function modifier($id, $titre, $desc, $cat, $dat) {
    $rqt = "UPDATE challenges SET title=?, description=?, category=?, deadline=? WHERE id_ch=?";
    $res = $this->db->prepare($rqt);
    return $res->execute([$titre, $desc, $cat, $dat, $id]);
}
    }
?>