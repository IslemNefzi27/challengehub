<?php
$id_ch = filter_input(INPUT_GET, 'id_ch', FILTER_VALIDATE_INT) ?: filter_input(INPUT_POST, 'id_ch', FILTER_VALIDATE_INT);

$old_data = $challengeModel->getById($id_ch);

if (!$old_data) {
    header("Location: index.php?action=challenge&error=notfound");
    exit();
}

if(isset($_POST['update']))
{
    $id_user = $_POST['id_user'];
    $pass = $_POST['passe'];

    $rqt = $db->prepare("SELECT * FROM user WHERE id_user=? AND mot_passe=?");
    $rqt->execute([$id_user, $pass]);
    
    if($rqt->fetch())
    {
        $res = $challengeModel->modifier($id_ch, $_POST['titre'], $_POST['desc'], $_POST['cat'], $_POST['date']);
        
        if($res){
            header("Location: index.php?action=challenge&msg=update_success");
            exit();
        } else {
            echo "<script>alert('Erreur lors de la modification');</script>";
        }
    } else {
        echo "<script>alert('Identification incorrect ou mot de passe incorrect');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Challenge</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="container" style="padding: 20px;">
        <h2>Modifier le Challenge <?= htmlspecialchars($id_ch); ?></h2>

        <form action="" method="post" class="form">
            <input type="hidden" name="id_ch" value="<?= $id_ch; ?>">

            <fieldset>
                <legend>Informations du Challenge</legend>
                <label>Titre:</label><br>
                <input type="text" name="titre" value="<?= htmlspecialchars($old_data['title']); ?>" required><br><br>

                <label>Description:</label><br>
                <textarea name="desc" required style="width:100%"><?= htmlspecialchars($old_data['description']); ?></textarea><br><br>

                <label>Catégorie:</label><br>
                <input type="text" name="cat" value="<?= htmlspecialchars($old_data['category']); ?>" required><br><br>

                <label>Deadline:</label><br>
                <input type="date" name="date" value="<?= $old_data['deadline']; ?>" required><br><br>
            </fieldset>

            <br>
            <fieldset>
                <legend>Confirmation d'identité</legend>
                <label>ID utilisateur:</label><br>
                <input type="text" name="id_user" placeholder="ID obligatoire..." required><br><br>

                <label>Mot de Passe:</label><br>
                <input type="password" name="passe" placeholder="Password obligatoire..." required><br><br>
            </fieldset>

            <div style="margin-top: 20px;">      
                <input type="submit" name="update" value="Enregistrer les modifications" style="background: green; color: white; padding: 10px; cursor: pointer;">
                <a href="index.php?action=challenge" style="margin-left: 10px;">Annuler</a>
            </div>
        </form>
    </div>
</body>
</html>