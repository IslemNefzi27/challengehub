<?php
$id_ch = $_GET['id_ch'] ?? 0; 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Commentaires</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<div class="container" style="max-width: 600px; margin: 20px auto; font-family: Arial;">
    <a href="index.php?action=challenge">⬅ Retour</a>
    
    <h2>Commentaires (ID Challenge: <?= htmlspecialchars($id_ch) ?>)</h2>

    <form action="index.php?action=post_comment" method="POST" style="margin-bottom: 20px;">
        <input type="hidden" name="id_ch" value="<?= $id_ch ?>">
        <textarea name="content" required style="width: 100%; padding: 10px;" placeholder="Votre message..."></textarea>
        <button type="submit" style="margin-top: 5px;">Envoyer</button>
    </form>

    <hr>

    <div class="comments-list">
        <?php if (empty($comments)): ?>
            <p style="color: red;">⚠️aucun donnees</p>
        <?php else: ?>
            <?php foreach ($comments as $com): ?>
                <div style="background: #f1f1f1; padding: 10px; border-bottom: 1px solid #ccc; margin-bottom: 10px;">
                    <strong>@<?= htmlspecialchars($com['nom_utilisateur'] ?? 'Utilisateur inconnu') ?></strong>
                    <p style="margin: 5px 0;"><?= nl2br(htmlspecialchars($com['content'])) ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
</body>
</html>