<?php
require('configuration.php');
$nom = $_POST['nom'];
$email = $_POST['email'];
$password = $_POST['motdepasse'];
$req="INSERT INTO inscription(name,email,password) VALUES('$nom','$email','$password')";
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