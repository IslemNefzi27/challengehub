<?php
// Chapitre 1 : Définition de la classe AuthController
class AuthController {
    private $userModel;

    public function __construct($model) {
        $this->userModel = $model;
    }

    // Affiche le formulaire de login
    public function showLoginForm() {
        include 'app/views/auth/login.php';
    }

    // Gère la tentative de connexion
    public function login() {
        // Récupération des données du formulaire POST (Cours p.37)
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Appel de la méthode login du modèle User
            $user = $this->userModel->login($email, $password);

            if ($user) {
                // Initialisation de la session (Partie I, p.38)
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // Redirection vers l'accueil/classement
                header("Location: index.php?action=ranking");
            } else {
                // Message d'erreur simple (p.7 echo)
                echo "Email ou mot de passe incorrect.";
            }
        }
    }

    // Gère la déconnexion (Cahier des charges 3.A)
    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy(); // Détruit la session
        header("Location: index.php?action=login");
    }
}
?>