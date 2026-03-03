<!DOCTYPE html>
<html>
<head>
    <title>ChallengeHub - Connexion</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

    <div style="width:300px; margin:50px auto; border:1px solid #ccc; padding:20px; border-radius:10px;">
        <h2>Connexion</h2>

        <form action="index.php?action=doLogin" method="post">
            <p>
                <label>Email :</label><br>
                <input type="email" name="email" required style="width:100%;">
            </p>
            
            <p>
                <label>Mot de passe :</label><br>
                <input type="password" name="password" required style="width:100%;">
            </p>

            <p>
                <input type="submit" value="Se connecter" style="width:100%; background-color:#4CAF50; color:white; border:none; padding:10px; cursor:pointer;">
            </p>
        </form>

        <p style="text-align:center; font-size:0.9em;">
            <a href="index.php?action=ranking">Retour au classement</a>
        </p>
    </div>

</body>
</html>