<?php

session_start();

require_once 'config/database.php';
try {
    $db = Database::getInstance();
} catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());
}


require_once 'app/models/users.php';
require_once 'app/models/vote.php';
require_once 'app/controle/authController.php';
require_once 'app/controle/voteController.php';
$userModel = new User($db); 
$voteModel = new Vote($db);

$authController = new AuthController($userModel);
$voteController = new VoteController($voteModel);


$action = isset($_GET['action']) ? $_GET['action'] : 'inscription';

switch ($action) {

    case 'inscription':
        $authController->showSignupForm(); 
        break;

    case 'signup': 
        $authController->signup();
        break;

    case 'login':
        $authController->showLoginForm();
        break;
        
    case 'doLogin':
        $authController->login(); 
        break;

    case 'logout':
        $authController->logout();
        break;

    case 'ranking':
        $voteController->ranking(); 
        break;

    case 'vote':
        $voteController->vote();
        break;

    default:
        $authController->showSignupForm();
        break;
}
?>