<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - ChallengeHub</title>
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
  

</head>
<body>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card profile-card p-4 text-center">
                <h3 class="fw-bold">Salut, <?= htmlspecialchars($user['nom_utilisateur']); ?>!</h3>
                <p class="text-muted mb-1 small"><?= htmlspecialchars($user['email_utilisateur']); ?></p>
                <span class="badge bg-light text-dark mb-4 border">ID: <?= htmlspecialchars($user['id_user']); ?></span>

                <form action="index.php?action=logout" method="post" class="mb-3">
                    <button type="submit" class="btn btn-outline-danger btn-sm w-100 btn-custom">Se Déconnecter</button>
                </form>

                <hr>
                
                <h5 class="text-start mb-3">Modifier le profil</h5>
                <form action="index.php?action=profile" method="post">
                    <div class="mb-2">
                        <input type="text" name="nom" class="form-control form-control-sm" placeholder="Nouveau nom">
                    </div>
                    <div class="mb-2">
                        <input type="email" name="email" class="form-control form-control-sm" placeholder="Email">
                    </div>
                    <div class="mb-2">
                        <input type="password" name="motdepasse" class="form-control form-control-sm" placeholder="Mot de passe">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm w-100 btn-custom">Enregistrer les modifications</button>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold m-0">Mes Challenges</h2>
                <a href="index.php?action=challenge" class="btn btn-dark btn-sm btn-custom">+ Nouveau</a>
            </div>

            <?php if (!empty($mes_challenges)): ?>
                <div class="list-group shadow-sm">
                    <?php foreach ($mes_challenges as $ch): ?>
                        <div class="list-group-item d-flex justify-content-between align-items-center p-3 challenge-item border-0">
                            <div>
                                <h6 class="mb-0 fw-semibold text-dark"><?= htmlspecialchars($ch['title']) ?></h6>
                                <small class="text-muted">Gérer ce défi</small>
                            </div>
                            <a href="index.php?action=edit_ch&id=<?= $ch['id_ch'] ?>" class="btn btn-warning btn-sm px-3 shadow-sm">
                                 Modifier
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center py-5 border-0 shadow-sm" style="border-radius: 15px;">
                    <p class="mb-0">Vous n'avez pas encore créé de challenges.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>