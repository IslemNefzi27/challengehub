<?php
require('configuration.php');
$nom = $_POST['nom'];
$email = $_POST['email'];
$password = $_POST['motdepasse'];
$confirm_password = $_POST['confirm_password'];
if($password !== $confirm_password){
    echo"<div>
    <p>Les mots de passe ne correspondent pas.</p>
    </div>";
    exit();
}
$req="INSERT INTO user(nom_utilisateur,email_utilisateur,mot_passe) VALUES('$nom','$email','$password')";
$res=mysqli_query($conn,$req);
if($res){
    echo"<div>
    <p>Votre inscription a été effectuée avec succès.</p>
    <a href='connexion.php'>se connecter</a>
    </div>";
}else{
    echo"<div>
    <p>Une erreur s'est produite lors de l'inscription. Veuillez réessayer.</p>
    <a href='inscription.html'>Retour à l'inscription</a>
    </div>";
}