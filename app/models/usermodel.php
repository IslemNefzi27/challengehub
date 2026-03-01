<?php
class usermodel{
    private $conn;
    public function __construct($connexion){
        $this->conn=$connexion; 
    }//constructeur
    public function creation($nom,$email,$hashed_password){
        $stmt=$this->conn->prepare("INSERT INTO user(nom_utilisateur,email_utilisateur,mot_passe)VALUES (?,?,?)");
        $stmt->bind_param("sss",$nom,$email,$hashed_password);
        return $stmt->execute();
    }//creation nouveau user
    public function trouvepemail($email){
        $stmt=$this->conn->prepare("SELECT * FROM user WHERE email_utilisateur = ?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $res=$stmt->get_result();
        return $res->fetch_assoc();
    }//trouver user par email
    public function emailexistant($email){
        $stmt=$this->conn->prepare("SELECT * FROM user WHERE email_utilisateur = ?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $res=$stmt->get_result();
        return $res->num_rows > 0;
    }
}
?>
