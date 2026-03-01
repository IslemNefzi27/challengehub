<?php
require('../models/UserModel.php');
$usermodel=new usermodel($conn);
$nom = $_POST['nom'];
$email = $_POST['email'];
$password = $_POST['motdepasse'];
$confirm_password = $_POST['confirm_password'];
if( empty($nom)||empty($email)||empty($password)||empty($confirm_password)){
    echo"<div>
    <p>Veuillez remplir tous les champs</p>
    exit();";
}//remplissage des champs
if($password!=$confirm_password){
    echo"<div>
    <p>Les mots de passe ne correspondent pas. Veuillez réessayer.</p>
    exit();";
}//password confirmation
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
//hashage du mot de passe
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
   echo"<div>
   <p>Adresse e-mail invalide. Veuillez entrer une adresse e-mail valide.</p>
    exit();";
}//validation d'email
if($usermodel->emailexistant($email)){
    echo"<div>
    <p>Adresse e-mail déjà utilisée</p>
    exit();";
}//validation d'email existant
$res=$usermodel->creation($nom,$email,$hashed_password);
if($res){
    echo"<div>
    <p>Inscription réussie. Bienvenue, $nom!</p>
    <a href='connexion.html'>Accéder à la page de connexion!</a>
    </div>";}
    else{die("erreur de s'inscrire");}
?>