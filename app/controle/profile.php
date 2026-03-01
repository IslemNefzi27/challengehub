<?php
session_start();
if(!isset($_SESSION['email'])){
    header('Location: connexion.html');
    exit();
}
require_once '../models/usermodel.php';
$pdo=new PDO('mysql:host=localhost;dbname=web','root','');
$usercontroller=new usercontroller($pdo);
$user=$usercontroller->usermodel->trouvepemail($_SESSION['email']);
if(!$user){
    die("Utilisateur non trouvé");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../view/style.css">
</head>
<body>
    <h1>Bienvenue, <?php echo htmlspecialchars($user['nom_utilisateur']); ?>!</h1>
    <p>Email: <?php echo htmlspecialchars($user['email_utilisateur']); ?></p>
    <form action="../controle/user.php?action=deconnecter" method="post">
        <input type="submit" value="Deconnecter" name="deconnecter" class="btn">
    </form>
    <h2>modifier votre profile</h2>
    <form action="modifierprofile.php" method="post">
        <input type="text" name="nom" placeholder="Nouveau nom" required>
        <input type="email" name="email" placeholder="Nouvelle adresse e-mail" required>
        <input type="password" name="motdepasse" placeholder="Nouveau mot de passe" required>
        <input type="password" name="confirm_motdepasse" placeholder="Confirmer le nouveau mot de passe" required>
        <input type="submit" value="Modifier Profile" class="btn">
    </form>
    <h3>Vos Challenges</h3>
</body>
</html>
    <?php
    require_once '../models/addchallenge.php';
    $servername="localhost";
    $username="root";
    $password="";
    $database="challengehub";
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$database", $username,$password);
    } catch (Exception $e) {
      die("Erreur : " . $e->getMessage());
    }
    $challenge=new challange($conn);
    $liste = $challenge->afficher_challenge($user['id']);
    foreach ($liste as $ch) {   
        echo "<div class='challenge'>";
        echo "<h4>" . htmlspecialchars($ch['title']) . "</h4>";
        echo "<p>" . htmlspecialchars($ch['description']) . "</p>";
        echo "<p>Catégorie: " . htmlspecialchars($ch['category']) . "</p>";
        echo "<p>Date limite: " . htmlspecialchars($ch['deadline']) . "</p>";
        echo "<a href='modifierchallenge.php?id=" . $ch['id_ch'] . "' class='btn'>Modifier</a>";
        echo "<form action='../controle/challenge.php?action=supprimer' method='post' style='display:inline;'>";
        echo "<input type='hidden' name='id_ch' value='" . $ch['id_ch'] . "'>";
        echo "<input type='submit' value='Supprimer' class='btn'>";
        echo "</form>";
        echo "</div>";
    }
