<!DOCTYPE html>
<html>
<head>
    <title>ChallengeHub - Classement</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

    <header>
        <h1>🏆 Mur des Célébrités</h1>
        
        <?php if(isset($_SESSION['nom_utilisateur'])): ?>
            <p>Bonjour, <strong><?php echo $_SESSION['username']; ?></strong> 
               | <a href="index.php?action=logout">Déconnexion</a></p>
        <?php else: ?>
            <p><a href="index.php?action=login">Connectez-vous pour voter !</a></p>
        <?php endif; ?>
    </header>

    <hr>

    <table border="1" style="width:80%; margin:auto; text-align:center;">
        <thead>
            <tr style="background-color: #eeeeee;">
                <th>Rang</th>
                <th>Participant</th>
                <th>Description du Défi</th>
                <th>Nombre de Votes</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
    <?php if (!empty($ranks)): ?>
        <?php foreach ($ranks as $index => $row): ?>
        <tr>
            <td><strong>#<?php echo $index + 1; ?></strong></td>
            <td><?php echo htmlspecialchars($row['nom_utilisateur']); ?></td>
            <td><?php echo htmlspecialchars($row['description']); ?></td>
            <td><?php echo $row['total_votes']; ?> ⭐</td>
            <td>
                <a href="index.php?action=vote&id=<?php echo $row['id_sub']; ?>" class="btn-vote">
                    Voter
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">Aucun classement disponible pour le moment.</td>
        </tr>
    <?php endif; ?>
</tbody>
    </table>

    <script src="public/js/script.js"></script>

</body>
</html>