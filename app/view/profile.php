<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="public/style.css"> 
</head>
<body>
    <h1>Bienvenue, <?= htmlspecialchars($user['nom_utilisateur']); ?>!</h1>
    
    <p>Email: <?= htmlspecialchars($user['email_utilisateur']); ?></p>
    <p>Identifiant: <?= htmlspecialchars($user['id_user']); ?></p>

    <form action="index.php?action=logout" method="post">
        <input type="submit" value="Deconnecter" class="btn">
    </form>

    <hr>
    <h2>Modifier votre profile</h2>
    <form action="index.php?action=profile" method="post">
        <input type="text" name="nom" placeholder="Nouveau nom">
        <input type="email" name="email" placeholder="Nouvelle adresse e-mail">
        <input type="password" name="motdepasse" placeholder="Nouveau mot de passe">
        <input type="submit" value="Modifier Profile" class="btn">
    </form>

    <h3>Vos Challenges</h3>
    <?php if (!empty($mes_challenges)): ?>
    <?php foreach ($mes_challenges as $ch): ?>
        <div class='challenge'>
            <h4><?= htmlspecialchars($ch['title']) ?></h4>
            <a href="index.php?action=edit_ch&id=<?= $ch['id_ch'] ?>" class="btn">Modifier</a>
        </div>
    <?php endforeach; ?>
    <?php else: ?>
    <p>Aucun challenge créé.</p>
<?php endif; ?>
</body>
</html>