<?php
require('../models/usermodel.php');

class UserController {
    private $usermodel;

    public function __construct($pdo) {
        $this->usermodel = new usermodel($pdo);
    }

    public function inscription($nom,$email,$password,$confirm_password){
             if( empty($nom)||empty($email)||empty($password)||empty($confirm_password)){
                 die("Veuillez remplir tous les champs");
                }//remplissage des champs
            if($password!==$confirm_password){
               die("Les mots de passe ne correspondent pas. Veuillez réessayer.");
                }//password confirmation
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                //hashage du mot de passe
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                 die("Adresse e-mail invalide");
                    }//validation d'email
            if($this->usermodel->emailexistant($email)){
                  die("Adresse e-mail déjà utilisée");
                }//validation d'email existant
           
$res=$this->usermodel->creation($nom,$email,$hashed_password);
if($res){
   header("Location: ../view/connexion.html");
   exit();}
else{die("erreur de s'inscrire");}
    
}
public function connexion($email,$password){
    session_start();
    $user=$this->usermodel->trouvepemail($email);
    if($user){
    if(password_verify($password, $user['mot_passe']))
        {$_SESSION['email']=$user['email_utilisateur'];
        header('Location: ../controle/challenge.php');
        exit();
    }else{
        die("Mot de passe incorrect");
    }
}else{
    die("Utilisateur non trouvé".htmlspecialchars($email));
}
}
public function deconnexion(){
    session_start();
    session_unset();
    session_destroy();
    header('location: ../view/connexion.html');
    exit();
}
}

$servername="localhost";
    $username="root";
    $password="";
    $database="challengehub";
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}
$model= new usermodel($pdo);
$controller = new UserController($pdo);

if(isset($_GET['action'])){
    $action=$_GET['action'];
    if($action=='inscription' && $_SERVER['REQUEST_METHOD']=='POST'){
        $controller->inscription($_POST['nom'],$_POST['email'],$_POST['motdepasse'],$_POST['confirm_motdepasse']);
    }
    elseif($action=='connexion' && $_SERVER['REQUEST_METHOD']=='POST'){
        $controller->connexion($_POST['email'],$_POST['motdepasse']);
    }
    elseif($action=='deconnecter' && $_SERVER['REQUEST_METHOD']=='POST'){
        $controller->deconnexion();
    }
}
?>