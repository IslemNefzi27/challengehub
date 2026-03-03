<?php
session_start();
if (!isset($_SESSION['email'])|| !isset($_SESSION['id'])) {
    header("Location: ../view/connexion.html");
    exit();
}
require_once '../models/usermodel.php';
$severname="localhost";
$username="root";
$password="";
$database="challengehub";
try {
    $pdo = new PDO("mysql:host=$severname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $usermodel = new usermodel($pdo);
    $user = $usermodel->supprimercompte($_POST['id']);
    if ($user) {
        session_destroy();
        header("Location: ../view/connexion.html");
    }
    else{
        die("Erreur lors de la suppression du compte");
    }
}
 catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}