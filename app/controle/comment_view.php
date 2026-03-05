<?php
// 1. Inclusions des fichiers

require_once '../../config/database.php';
require_once '../models/Comment.php';
require_once '../controle/CommentController.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1;
}

// 2. Initialisation
$db = Database::getInstance();
$commentModel = new Comment($db);
$commentController = new CommentController($db);

// 3. Routage
$action = $_GET['action'] ?? 'view';
$id_submission = 1; 

if ($action === 'post_comment') {
    $commentController->store();
    header("Location: comment_view.php?msg=success");
    exit();
}

// 4. Récupération des données
$comments = $commentModel->getCommentsBySubmission($id_submission);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Système de Commentaires</title>
    <link rel="stylesheet" href="../../public/css/style.css">
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
        <h3>les commentaires </h3>
        <?php if (empty($comments)): ?>
            <p>Aucun commentaire !</p>
        <?php else: ?>
            <?php foreach ($comments as $com): ?>
                <div class="comment-card">
                    <small class="comment-date">
                        le <?= date('d/m/Y à H:i', strtotime($com['date_creation'])) ?>
                    </small>
                    <strong>@<?= htmlspecialchars($com['nom_utilisateur']) ?></strong> 
                    <div class="comment-content">
                        <?= nl2br(htmlspecialchars($com['content'])) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</div>

</body>
</html>