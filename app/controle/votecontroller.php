<?php
// Chapitre 1 : La Programmation Orienté Objet (POO)
class VoteController {
    private $voteModel;

    // Constructeur pour recevoir le modèle (p.10 du cours)
    public function __construct($model) {
        $this->voteModel = $model;
    }

    // Méthode pour l'action de voter
    public function vote() {
        // Utilisation des sessions (Cours Partie I, p.38)
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Vérification si l'utilisateur est connecté et si l'ID existe (p.28)
        if (isset($_SESSION['user_id']) && isset($_GET['id'])) {
            $userId = $_SESSION['user_id'];
            $submissionId = $_GET['id'];

            // Appel de la méthode du modèle Vote
            $this->voteModel->addVote($userId, $submissionId);
        }

        // Redirection vers le classement (p.40)
        header("Location: index.php?action=ranking");
    }

    // Méthode pour afficher le classement
    public function ranking() {
        // Récupération des données via le modèle (Chapitre 2 - PDO)
        $ranks = $this->voteModel->getRanking();

        // Inclusion de la vue pour l'affichage (p.20 du cours)
        include 'app/views/votes/ranking.php';
    }
}
?>