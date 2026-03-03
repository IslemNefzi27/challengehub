<?php 
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../view/connexion.html");
    exit();
}
require_once '../models/usermodel.php';
$servername="localhost";
$username="root";
$password="";
$database="challengehub";
$pdo=new PDO("mysql:host=$servername;dbname=$database",$username,$password);
$usermodel=new UserModel($pdo);
$usernow=$usermodel->trouvepemail($_SESSION['email']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $motdepasse = $_POST['motdepasse'] ?? '';
    $confirm_motdepasse = $_POST['confirm_motdepasse'] ?? '';
    if (!empty($motdepasse) && $motdepasse !== $confirm_motdepasse) {
        die("Les mots de passe ne correspondent pas.");
    }
    if (!empty($email) && $email !== $usernow['email_utilisateur'] && $usermodel->emailexistant($email)) {
        die("L'adresse e-mail est déjà utilisée.");
    }
    if ($usermodel->modifierprofile($usernow['id'], $nom, $email, $motdepasse)) {
        echo "Profile modifié avec succès.";
        $_SESSION['email'] = !empty($email) ? $email : $_SESSION['email'];
        header("Location: profile.php");
        exit();
    } else {
        die("Erreur lors de la modification du profile.");
    }
}
