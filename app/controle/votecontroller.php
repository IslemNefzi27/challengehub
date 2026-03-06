<?php
class VoteController {
    private $voteModel;

    public function __construct($model) {
        $this->voteModel = $model;
    }

    public function showChallengeForm() {
        if (!isset($_SESSION['username'])) {
            header("Location: index.php?action=login");
            exit();
        }
        $liste = $this->voteModel->afficher_challenge(); 
        include 'app/view/challenge.php'; 
    }

    public function ranking() {
        $ranks = $this->voteModel->getRanking(); 
        include 'app/view/ranking.php';
    }

    public function addChallenge() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_user = $_SESSION['user_id'];
            
            $titre = $_POST['titre'] ?? '';
            $cat   = $_POST['categorie'] ?? '';
            $desc  = $_POST['des'] ?? '';
            $dat   = $_POST['date'] ?? '';
    
            $res = $this->voteModel->ajouter($id_user, $titre, $cat, $desc, $dat);
    
            if ($res) {
                header("Location: index.php?action=challenge&success=1");
                exit();
            } else {
                die("Erreur base de données.");
            }
        }
    }

}
    
