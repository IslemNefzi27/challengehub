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
            $id_user = $_SESSION['user_id'] ?? null;
    
            if (!$id_user) {
                die("Error: Impossible d'ajouter. L'utilisateur n'est pas identifié (ID missing).");
            }
    
            $titre = $_POST['titre'] ?? '';
            $desc = $_POST['des'] ?? '';
            $cat = $_POST['categorie'] ?? '';
            $dat = $_POST['date'] ?? '';
            $res = $this->voteModel->ajouter($titre, $desc, $cat, $dat, $id_user);
        }
    }
  }
    
