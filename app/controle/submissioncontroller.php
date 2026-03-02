<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once '../../config/db.php';
require_once '../models/Submission.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php"); 
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'submit'){
        $challenge_id = mysqli_real_escape_string($conn, $_POST['challenge_id']);
        $description = $_POST['description'];
        $content_link = $_POST['content_link'];
        $user_id = $_SESSION['user_id'];
        if (addSubmission($conn, $challenge_id, $user_id, $description, $content_link)) {
            header("Location: ../../public/index.php"); 
            exit();
        } else {
            die("Erreur SQL : " . mysqli_error($conn));
        }
    }
}
?>