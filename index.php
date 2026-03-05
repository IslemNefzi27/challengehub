<?php
session_start();

require_once 'config/database.php';
$db = Database::getInstance();

require_once 'app/models/users.php';
require_once 'app/models/vote.php';
require_once 'app/models/modeladdchallenge.php'; 
require_once 'app/models/Comment.php';
require_once 'app/controle/authController.php';
require_once 'app/controle/voteController.php';
require_once 'app/models/usermodel.php';

$userModel = new usermodel($db); 
$authController = new AuthController($userModel);
$userModel      = new User($db); 
$voteModel      = new Vote($db);
$challengeModel = new challange($db); 
$commentModel   = new Comment($db); 

$authController = new AuthController($userModel);
$voteController = new VoteController($voteModel);

$action = $_REQUEST['action'] ?? 'inscription';

switch ($action) {
    case 'inscription':
        $authController->showSignupForm(); 
        break;
    case 'participer':
        include 'app/view/add.php';
        break;
    case 'signup': 
        $authController->signup();
        break;

    case 'doLogin': 
            $authController->login();
        break;

    case 'challenge':
        $voteController->showChallengeForm(); 
        break;
    case 'profile':
            if (isset($_SESSION['email_utilisateur'])) {
                $user = $userModel->trouvepemail($_SESSION['email']);
                $mes_challenges = $challengeModel->afficher_challenge_supp($user['email_utilisateur']);
                include 'app/view/profile.php';
                exit(); 
            }
            break;
    case 'showAddForm':
        include 'app/view/addchallenge.php'; 
        break;

    case 'doInsertChallenge':
        $voteController->addChallenge();
        break;

    case 'edit_ch':
        include 'app/controle/modifier.php';
        break;

    case 'update_challenge':
        $voteController->updateChallenge();
        break;

    case 'delete_ch':
        include 'app/controle/supperimer.php';
        break;
    case 'view_comments':
        $id_ch = $_GET['id_ch'] ?? 0;
        $comments = $commentModel->getCommentsByChallenge($id_ch);
        include 'app/view/comment_view.php'; 
        break;

    case 'post_comment':

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_ch = $_POST['id_ch'];
            $content = $_POST['content'];
            $id_user = $_SESSION['user_id'] ?? 1;
            
            $commentModel->addComment($id_ch, $id_user, $content);
           
            header("Location: index.php?action=view_comments&id_ch=$id_ch&msg=success");
            exit();
        }
        break;

    case 'ranking':
        $voteController->ranking();
        break;

        case 'login':
            $authController->showLoginForm(); 
            break;

    default:
        $authController->showSignupForm();
        break;
}