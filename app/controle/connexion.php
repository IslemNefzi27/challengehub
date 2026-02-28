<?php
require('configuration.php');
session_start();
if(isset($_SESSION['email']) && isset($_SESSION['motdepasse'])){
    header('Location: challenges.html');
    exit();
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
$email=$_POST['email'];
$password=$_POST['motdepasse'];}

if(empty($email) || empty($password)){
    echo"<div>
    <p>Veuillez remplir tous les champs.</p>
    <a href='connexion.html'>Retour à la connexion</a>
    </div>";
    exit();
}
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo"<div>
    <p>Adresse e-mail invalide. Veuillez entrer une adresse e-mail valide.</p>
    <a href='connexion.html'>Retour à la connexion</a>
    </div>";
    exit();
}
$req="SELECT * FROM user WHERE email_utilisateur='$email' AND mot_passe='$password'";
$res=mysqli_query($conn,$req);
if($res){
    if(mysqli_num_rows($res)==1){
        echo"<div>
        <p>Connexion réussie. Bienvenue, $email!</p>
        <a href='challenges.html'>Accéder à la page de défis!</a>
        </div>";
    }else{
        echo"<div>
        <p>Adresse e-mail ou mot de passe incorrect. Veuillez réessayer.</p>
        <a href='connexion.html'>Retour à la connexion</a>
        </div>";
    }
}