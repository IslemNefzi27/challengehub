<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<body class="bg-light"> <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="max-width: 450px; width: 100%;">
            <div class="card-body">
                <h2 class="text-center mb-3">Créer un compte</h2>
                <p class="text-center text-muted mb-4">Rejoignez la communauté ChallengeHub !</p>

                <form action="index.php?action=signup" method="POST">
                    
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom et prénom :</label>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Ex: Mohamed Salah" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email :</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="exemple@mail.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="motdepasse" class="form-label">Mot de passe :</label>
                        <input type="password" class="form-control" id="motdepasse" name="motdepasse" required>
                    </div>

                    <div class="mb-3">
                        <label for="confirm_motdepasse" class="form-label">Confirmer le mot de passe :</label>
                        <input type="password" class="form-control" id="confirm_motdepasse" name="confirm_motdepasse" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">S'inscrire</button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <p class="mb-0">Vous avez déjà un compte ? <a href="index.php?action=login" class="text-decoration-none">Connectez-vous</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</body>
</html>