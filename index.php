<?php
// 1. Démarrage de la session
// Indispensable pour savoir qui est connecté et qui vote
session_start();

// 2. Connexion à la base de données avec PDO 
$host = "localhost";
$dbname = "challengehub2"; // Nom de ton dossier/BD
$user = "root";
$pass = "";

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // Configuration pour afficher les erreurs SQL (pratique pour le débuggage)
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// 3. Inclusion des modèles et contrôleurs 
// On utilise require_once pour éviter les erreurs de double inclusion
require_once 'app/models/users.php';
require_once 'app/models/vote.php';
require_once 'app/controllers/authController.php';
require_once 'app/controllers/voteController.php';

// 4. Instanciation des objets
// On passe l'objet $db aux modèles pour qu'ils puissent faire des requêtes
$userModel = new User($db);
$voteModel = new Vote($db);

$authController = new AuthController($userModel);
$voteController = new VoteController($voteModel);

// 5. Routage : Quelle action l'utilisateur veut-il faire ? 
// On récupère l'action dans l'URL (ex: index.php?action=login)
$action = isset($_GET['action']) ? $_GET['action'] : 'ranking';

switch ($action) {
    // --- Partie Authentification ---
    case 'login':
        $authController->showLoginForm();
        break;
        
    case 'doLogin':
        $authController->login();
        break;
        
    case 'logout':
        $authController->logout();
        break;

    // --- Partie Votes et Classement  ---
    case 'vote':
        $voteController->vote();
        break;

    case 'ranking':
        $voteController->ranking();
        break;

    // --- Action par défaut ---
    default:
        $voteController->ranking();
        break;
}
?>