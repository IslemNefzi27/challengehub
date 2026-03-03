<?php
session_start();
require_once '../models/modeladdchallenge.php';

require_once '../../config/database.php';
$conn = Database::getInstance();

$id_ch = filter_input(INPUT_GET, 'id_ch', FILTER_VALIDATE_INT) ?: filter_input(INPUT_POST, 'id_ch', FILTER_VALIDATE_INT);

if(isset($_POST['supp']))
{
    $id_user = $_POST['id_user'];
    $pass = $_POST['passe'];

    $rqt=$conn->prepare("SELECT * FROM user WHERE id_user=? AND mot_passe=?");
    $rqt->execute([$id_user, $pass]);
    if($rqt->fetch())
    {
        $nv = new challange($conn);
        $res = $nv->supprimer($id_ch, $id_user);
        
        if($res){
            header("Location: challenge.php?msg=success_delete");
            exit();
        } else {
            echo "<script>alert('............................');</script>";
        }
    } else {
        echo "<script>alert('Identification incorrect ou bien mot de passe incorrect');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de suppression</title>
    <link rel="stylesheet" href="../view/style.css">
</head>
<body>
    <form action="" method="post">
        <input type="hidden" name="id_ch" value="<?php echo htmlspecialchars($id_ch); ?>">
        
        <label>l'identification_user</label>
        <input type="text" name="id_user" placeholder="Votre ID..." required>
        <br><br>
        
        <label>Mot de Passe</label>
        <input type="password" name="passe" placeholder="Votre mot de passe..." required>
        <br><br>
        
        <input type="submit" value="Supprimer challange" class="supp" name="supp">
    </form>
</body>
</html>