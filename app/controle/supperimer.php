<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../view/style.css">
</head>
<body>
    <form action="challenge.php" method="post">
        <label for="">l'identification</label>
        <input type="text" placeholder="l'identification svp....">
        <br><br>
        <label for="">Mot de Passe</label>
        <input type="password" name="" id="" placeholder="Mot passe svp....">
        <br><br>
        <input type="submit" value="Supprimer challange" class="supp">
    </form>
<?php
session_start();
require_once '../models/modeladdchallenge.php';
$servername="localhost";
$username="root";
$password="";
$database="challengehub";
try {
  $conn = new PDO("mysql:host=$servername;dbname=$database", $username,$password);
} catch (Exception $e) {
  die("Erreur : " . $e->getMessage());
}
// On vérifie si l'utilisateur est bien connecté
if (!isset($_SESSION['id_user'])) {
    die("Action interdite : vous devez être connecté.");
}

if (isset($_GET['id_ch'])) {
    $obj = new challange($conn);
    
    // On passe l'ID du challenge ET l'ID de l'utilisateur connecté
    $succes = $obj->supprimer($_GET['id_ch'], $_SESSION['id_user']);

    if ($succes && $conn->rowCount() > 0) {
        header("Location: challenge.php?msg=supprime");
    } else {
        header("Location: challenge.php?msg=erreur_proprietaire");
    }
}
exit();
?>
</body>
</html>
