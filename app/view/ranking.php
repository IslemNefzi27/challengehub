<!DOCTYPE html>
<html>
<head>
    <title>ChallengeHub - Classement</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

    <header>
        <h1>🏆 Mur des Célébrités</h1>
        
        <?php if(isset($_SESSION['username'])): ?>
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
            <?php foreach ($ranks as $index => $row): ?>
            <tr>
                <td><strong>#<?php echo $index + 1; ?></strong></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['total_votes']; ?> ⭐</td>
                <td>
                    <a href="index.php?action=vote&id=<?php echo $row['sub_id']; ?>">
                        Voter
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script src="public/js/script.js"></script>

</body>
</html>