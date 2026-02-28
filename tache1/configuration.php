<?php
define('serveur', 'localhost');
define('utilisateur', 'root');  
define('motdepasse', '');
define('basededonnees', 'gestion_des_utilisateurs');
$conn = mysqli_connect(serveur, utilisateur, motdepasse, basededonnees);
if (!$conn) {
    die("La connexion a échoué: " . mysqli_connect_error());
}