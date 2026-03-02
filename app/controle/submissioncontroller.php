<?php
session_start();
require_once '../../config/db.php';
require_once '../models/submission.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'submit') {
    if (!isset($_SESSION['user_id'])) { $_SESSION['user_id'] = 1; }
    try {
        $success = addSubmission(
            $pdo, 
            $_POST['id_ch'], 
            $_SESSION['user_id'], 
            $_POST['description'], 
            $_POST['sub_id']
        );

        if ($success) {
            header("Location: ../../public/index.php?success=1");
            exit();
        }
    } catch (PDOException $e) {
        die("Erreur PDO : " . $e->getMessage());
    }
}
?>
