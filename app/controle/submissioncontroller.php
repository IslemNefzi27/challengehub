<?php
session_start();
require_once '../../config/db.php';
require_once '../models/submission.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ID de l'utilisateur par défaut pour le test
    $id_user = $_SESSION['user_id'] ?? 1;

    try {
        if (addSubmission($pdo, $_POST['id_ch'], $id_user, $_POST['description'], $_POST['sub_id'])) {
            echo "<h2>Soumission réussie !</h2>";
            echo "<a href='../views/submissions/add.php'>Retour au formulaire</a>";
        }
    } catch (PDOException $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
}
?>
