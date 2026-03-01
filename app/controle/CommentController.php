<?php
require_once '../app/models/Comment.php';
class CommentController {
    private $commentModel;

    public function __construct($db) {
        $this->commentModel = new Comment($db);
    }

    public function store() {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['content'])) {
            $id_s = $_POST['id_sub'];
            $id_user = $_SESSION['user_id'];
            $content = $_POST['content'];

            if ($this->commentModel->addComment($id_s, $id_user, $content)) {
            
                    header("Location: app/view/index.php?msg=success");
            } else {
                echo "Erreur lors de l'ajout du commentaire.";
            }
        }
    }
}