<?php
require_once 'C:\wamp64\www\config\database.php';
require_once 'models/Comment.php';
require_once 'controllers/CommentController.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1;
}

//Initialisation
$db = Database::getInstance();
$commentModel = new Comment($db);
$commentController = new CommentController($db);

//Routage
$action = $_GET['action'] ?? 'view';
$id_submission = 1; 

// Ajouter
if ($action === 'post_comment') {
    $commentController->store();
    header("Location: comment_view.php?msg=success");
    exit();
}

// Supprimer
if ($action === 'delete_comment' && isset($_GET['id_comm'])) {
    $id_comm = intval($_GET['id_comm']);
    $user_id = $_SESSION['user_id'];
    
    if ($commentModel->deleteComment($id_comm, $user_id)) {
        header("Location: comment_view.php?msg=deleted");
    } else {
        header("Location: comment_view.php?msg=error");
    }
    exit();
}

//  Modifier 
if ($action === 'edit_comment' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_comm = intval($_POST['id_comm']);
    $user_id = $_SESSION['user_id'];
    $content = $_POST['content'];
    
    if ($commentModel->updateComment($id_comm, $user_id, $content)) {
        header("Location: comment_view.php?msg=updated");
    } else {
        header("Location: comment_view.php?msg=error");
    }
    exit();
}

// Récupération des données
$comments = $commentModel->getCommentsBySubmission($id_submission);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Système de Commentaires</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>

<div class="container">
    <h2>Espace Commentaires</h2>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
        <div class="alert"> Votre commentaire a été publié </div>
    <?php endif; ?>

    <section>
        <form action="comment_view.php?action=post_comment" method="POST">
            <input type="hidden" name="id_sub" value="<?= $id_submission ?>">
            <textarea name="content" rows="3" required placeholder="Écrivez un commentaire..."></textarea>
            <button type="submit">Publier</button>
        </form>
    </section>

    <hr>
       <section>
    <h3>Les commentaires</h3>
    
    <?php if (isset($_GET['msg']) && ($_GET['msg'] === 'deleted' || $_GET['msg'] === 'updated')): ?>
        <div class="alert">
            <?php 
                if($_GET['msg'] == 'deleted') echo "Commentaire supprimé.";
                if($_GET['msg'] == 'updated') echo "Commentaire mis à jour.";
            ?>
        </div>
    <?php endif; ?>

    <?php if (empty($comments)): ?>
        <p>Aucun commentaire !</p>
    <?php else: ?>
        <?php foreach ($comments as $com): ?>
            <div class="comment-card" id="comment-<?= $com['id_comm'] ?>">
                <small class="comment-date">
                    le <?= date('d/m/Y à H:i', strtotime($com['date_creation'])) ?>
                </small>
                <strong>@<?= htmlspecialchars($com['nom_utilisateur']) ?></strong> 
                
                <div class="comment-content" id="text-<?= $com['id_comm'] ?>">
                    <?= nl2br(htmlspecialchars($com['content'])) ?>
                </div>

                <form action="comment_view.php?action=edit_comment" method="POST" id="edit-form-<?= $com['id_comm'] ?>" style="display:none;">
                    <input type="hidden" name="id_comm" value="<?= $com['id_comm'] ?>">
                    <textarea name="content" required><?= htmlspecialchars($com['content']) ?></textarea>
                    <button type="submit" class="btn-save">Enregistrer</button>
                    <button type="button" class="btn-cancel" onclick="toggleEdit(<?= $com['id_comm'] ?>)">Annuler</button>
                </form>

                <?php if ($com['id_user'] == $_SESSION['user_id']): ?>
                    <div class="comment-actions">
                        <button class="btn-edit" onclick="toggleEdit(<?= $com['id_comm'] ?>)">Modifier</button>
                        <a href="comment_view.php?action=delete_comment&id_comm=<?= $com['id_comm'] ?>" 
                           class="btn-delete" 
                           onclick="return confirm('Supprimer ce commentaire ?')">Supprimer</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</section>
</div>
<script>
function toggleEdit(id) {
    const textDiv = document.getElementById('text-' + id);
    const editForm = document.getElementById('edit-form-' + id);
    
    if (editForm.style.display === 'none') {
        editForm.style.display = 'block';
        textDiv.style.display = 'none';
    } else {
        editForm.style.display = 'none';
        textDiv.style.display = 'block';
    }
}
</script>
</body>
</html>

