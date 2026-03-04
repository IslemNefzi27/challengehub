<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>ChallengeHub - Inscription</title>
</head>
<body>  
    <div class="container">
        <h2>Créer un compte</h2>
        <p>Rejoignez la communauté ChallengeHub !</p>

        <form action="index.php?action=signup" method="POST">
            
            <label for="nom">Nom et prénom :</label>
            <input type="text" id="nom" name="nom" placeholder="Ex: Mohamed Salah" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" placeholder="exemple@mail.com" required>

            <label for="motdepasse">Mot de passe :</label>
            <input type="password" id="motdepasse" name="motdepasse" required>

            <label for="confirm_motdepasse">Confirmer le mot de passe :</label>
            <input type="password" id="confirm_motdepasse" name="confirm_motdepasse" required>

            <br>
            <button type="submit">S'inscrire</button>
        </form>

        <div class="footer-links">
            <p>Vous avez déjà un compte ? <a href="index.php?action=login">Connectez-vous</a></p>
        </div>
    </div>
</body>
</html>