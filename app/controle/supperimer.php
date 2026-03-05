<?php

$id_ch = filter_input(INPUT_GET, 'id_ch', FILTER_VALIDATE_INT) ?: filter_input(INPUT_POST, 'id_ch', FILTER_VALIDATE_INT);

if(isset($_POST['supp']))
{
    $id_user = $_POST['id_user'];
    $pass = $_POST['passe'];

    $rqt = $db->prepare("SELECT * FROM user WHERE id_user=? AND mot_passe=?");
    $rqt->execute([$id_user, $pass]);
    
    if($rqt->fetch())
    {
        $res = $challengeModel->supprimer($id_ch, $id_user);
        
        if($res){
            header("Location: index.php?action=challenge&msg=success_delete");
            exit();
        } else {
            echo "<script>alert('Error: Impossible de supprimer');</script>";
        }
    } else {
        echo "<script>alert('Identification incorrecte ou mot de passe incorrect');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de suppression</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div style="max-width:400px; margin:50px auto; padding:20px; border:1px solid #ddd; text-align:center;">
        <h3>Confirmation de suppression</h3>
        <form action="" method="post">
            <input type="hidden" name="id_ch" value="<?= htmlspecialchars($id_ch); ?>">
            
            <label>Identifiant User</label><br>
            <input type="text" name="id_user" required style="width:100%; margin-bottom:10px;"><br>
            
            <label>Mot de Passe</label><br>
            <input type="password" name="passe" required style="width:100%; margin-bottom:20px;"><br>
            
            <input type="submit" value="Supprimer" name="supp" style="background:red; color:white; padding:10px 20px; cursor:pointer; border:none;">
            <br><br>
            <a href="index.php?action=challenge">Annuler</a>
        </form>
    </div>
</body>
</html>