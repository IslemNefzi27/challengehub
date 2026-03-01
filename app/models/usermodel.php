<?php
class usermodel{
    private $pdo;
    public function __construct($pdo){
        $this->pdo=$pdo; 
    }//constructeur
    public function creation($nom,$email,$hashed_password){
        $stmt=$this->pdo->prepare("INSERT INTO user(nom_utilisateur,email_utilisateur,mot_passe)VALUES (?,?,?)");
        return $stmt->execute([$nom,$email,$hashed_password]);
    }//creation nouveau user
    public function trouvepemail($email){
        $stmt=$this->pdo->prepare("SELECT * FROM user WHERE email_utilisateur = :email");
        $stmt->execute([':email'=>$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }//trouver user par email
    public function emailexistant($email){
        $stmt=$this->pdo->prepare("SELECT COUNT(*) FROM user WHERE email_utilisateur = :email");
        $stmt->execute([':email'=>$email]);
        return $stmt->fetchColumn() > 0;
    }//verifier si email existe
}
?>
