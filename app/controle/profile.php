<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../view/connexion.html");
    exit();
}
require_once '../models/usermodel.php';
require_once '../models/modeladdchallenge.php';
$servername="localhost";
$username="root";
$password="";
$database="challengehub";
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $usermodel = new usermodel($pdo);
    $user = $usermodel->trouvepemail($_SESSION['email']);
    if (!$user) {
        die("Utilisateur introuvable");
    }
}
 catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
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
        <input type="text" name="nom" placeholder="Nouveau nom" >
        <input type="email" name="email" placeholder="Nouvelle adresse e-mail" >
        <input type="password" name="motdepasse" placeholder="Nouveau mot de passe" >
        <input type="password" name="confirm_motdepasse" placeholder="Confirmer le nouveau mot de passe" >
        <input type="submit" value="Modifier Profile" class="btn">
    </form>
    <h3>Vos Challenges</h3>
    <?php
    $challenge=new challange($pdo);
    $liste = $challenge->afficher_challenge_supp($user['id']);
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

    ?>
</body>
</html>