<?php
session_start();
require_once 'config/database.php';
$db = Database::getInstance();
require_once 'app/models/usermodel.php';  
require_once 'app/models/modeladdchallenge.php';   
require_once 'app/models/Comment.php';          
// require_once 'app/models/vote.php';            

require_once 'app/controle/authController.php';
require_once 'app/controle/voteController.php';
$userModel      = new usermodel($db);
$challengeModel = new challange($db);
$commentModel   = new Comment($db);
$authController = new AuthController($userModel);
$voteController = new VoteController($challengeModel); 
$action = $_REQUEST['action'] ?? 'inscription';

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

    case 'profile':
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nom   = $_POST['nom'] ?: $_SESSION['username']; 
            $email = $_POST['email'] ?: $_SESSION['email'];
            $mdp   = $_POST['motdepasse'] ?: null;
            
            $res = $userModel->modifierprofile($_SESSION['user_id'], $nom, $email, $mdp);
            if ($res) {
                $_SESSION['username'] = $nom;
                $_SESSION['email']    = $email;
                header("Location: index.php?action=profile&success=updated");
                exit();
            }
        }
        $user = $userModel->trouvepemail($_SESSION['email']);
        $mes_challenges = $challengeModel->afficher_challenge_supp($_SESSION['user_id']);
        
        include 'app/view/profile.php';
        break;
        case 'delete_profile':
            if (!isset($_SESSION['user_id'])) {
                header("Location: index.php?action=login");
                exit();
            }
        
            $id_user = $_SESSION['user_id'];
            if ($userModel->supprimerCompte($id_user)) {
                session_destroy();
                header("Location: index.php?action=inscription&msg=account_deleted");
            } else {
                header("Location: index.php?action=profile&error=delete_failed");
            }
            exit();
            break;
    case 'challenge':
        $voteController->showChallengeForm(); 
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

    case 'ranking':
        $voteController->ranking();
        break;
    case 'view_comments':
        $id_ch = $_GET['id_ch'] ?? 0;
        $comments = $commentModel->getCommentsByChallenge($id_ch);
        include 'app/view/comment_view.php'; 
        break;

    case 'post_comment':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_ch   = $_POST['id_s'] ?? $_POST['id_submission'] ?? 0;
            $content = $_POST['content'];
            $id_user = $_SESSION['user_id'] ?? 0;
            
            if ($id_user > 0) {
                $commentModel->addComment($id_ch, $id_user, $content);
                header("Location: index.php?action=view_comments&id_ch=$id_ch&msg=success");
            } else {
                header("Location: index.php?action=login");
            }
            exit();
        }
        break;
        //
        case 'vote':
            if (!isset($_SESSION['user_id'])) {
                header("Location: index.php?action=login&msg=must_login");
                exit();
            }
            
            $id_ch = $_GET['id_ch'] ?? 0;
            $id_user = $_SESSION['user_id'];
            if ($challengeModel->ajouterVote($id_ch, $id_user)) {
                header("Location: index.php?action=ranking&success=voted");
            } else {
                header("Location: index.php?action=ranking&error=already_voted");
            }
            break;
        //

case 'delete_comment':
    if (isset($_SESSION['user_id']) && isset($_GET['id_comm'])) {
        $id_comm = intval($_GET['id_comm']);
        $id_user = $_SESSION['user_id'];
        
        if ($commentModel->deleteComment($id_comm, $id_user)) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "&msg=deleted");
        } else {
            echo "Erreur lors de la suppression.";
        }
    }
    break;

    case 'edit_comment':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $id_comm = intval($_POST['id_comm']);
            $id_user = $_SESSION['user_id'];
            $content = $_POST['content'];
            $id_ch   = $_POST['id_ch'];

            if ($commentModel->updateComment($id_comm, $id_user, $content)) {
                header("Location: index.php?action=view_comments&id_ch=$id_ch&msg=updated");
            } else {
                echo "Erreur lors de la modification.";
            }
        }
        break;
        //
        case 'doInsertSubmission':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id_ch = $_POST['id_ch'];
                $desc  = $_POST['description'];
                $link  = $_POST['content_link']; 
                $id_user = $_SESSION['user_id'] ?? 0;
        
                if ($id_user > 0) {
                    $stmt = $db->prepare("INSERT INTO submissions (id_ch, id_user, description, content_link) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$id_ch, $id_user, $desc, $link]);
                    
                    header("Location: index.php?action=lst&msg=success");
                } else {
                    header("Location: index.php?action=login");
                }
                exit();
            }
            break;
        //
    case 'participer':
        include 'app/view/add.php';
        break;
        case 'lst':
            $search = $_GET['search'] ?? '';
            $pdo = $db; 
        
            if ($search) {
                $stmt = $pdo->prepare("SELECT * FROM submissions WHERE id_ch = ? ");
                $stmt->execute([$search]);
            } else {
                $stmt = $pdo->query("SELECT * FROM submissions ");
            }
            $submissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            include 'app/view/list.php';
            break;
            //
case 'delete_sub':
    if (isset($_GET['id'])) {
        $id_sub = intval($_GET['id']);
        $stmt = $db->prepare("DELETE FROM submissions WHERE id_sub = ?");
        $stmt->execute([$id_sub]);
        header("Location: index.php?action=lst&msg=deleted");
    }
    break;
case 'edit_sub':
    $id = $_GET['id'] ?? null;
    $stmt = $db->prepare("SELECT * FROM submissions WHERE id_sub = ?");
    $stmt->execute([$id]);
    $sub = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$sub) die("Soumission non trouvée");
    include 'app/view/edit.php'; 
    break;
case 'update_sub':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_GET['id'];
        $desc = $_POST['description'];
        $link = $_POST['content_link'];
        
        $stmt = $db->prepare("UPDATE submissions SET description = ?, content_link = ? WHERE id_sub = ?");
        $stmt->execute([$desc, $link, $id]);
        
        header("Location: index.php?action=lst&msg=updated");
        exit();
    }
    break;
            //
    default:
        $authController->showSignupForm();
        break;
}