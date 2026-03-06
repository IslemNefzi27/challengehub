<?php
class AuthController {
    private $userModel;

    public function __construct($model) {

        $this->userModel = $model;
    }


    public function showLoginForm() {
        include 'app/view/login.php';
    }


    public function showSignupForm() {
        include 'app/view/inscription.php'; 
    }

    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nom = $_POST['nom'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['motdepasse'] ?? '';
            $confirm = $_POST['confirm_motdepasse'] ?? '';
    
            if ($password !== $confirm) {
                die("Les mots de passe ne correspondent pas.");
            }
    
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $res = $this->userModel->creation($nom, $email, $hashed);
    
            if ($res) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user_id']  = $res; 
                $_SESSION['username'] = $nom;
                $_SESSION['email']    = $email;
                
                header("Location: index.php?action=challenge");
                exit();
            } else {
                die("Erreur lors de l'inscription.");
            }
        }
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $user = $this->userModel->login($email, $password);
            if ($user && password_verify($password, $user['mot_passe'])) {
                if (session_status() == PHP_SESSION_NONE) session_start();
                $_SESSION['user_id'] = $user['id_user'] ?? $user['id_user']; 
                $_SESSION['username'] = $user['nom_utilisateur'];
            
                header("Location: index.php?action=challenge");
                exit();
            } else {
                echo "Email ou mot de passe incorrect.";
            }
        }
    }
    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header("Location: index.php?action=login");
        exit();
    }
}
?>