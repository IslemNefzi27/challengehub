<?php
session_start();
require_once '../models/modeladdchallenge.php';

$servername="localhost"; $username="root"; $password=""; $database="challengehub";
try {
  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
} catch (Exception $e) { die("Erreur : " . $e->getMessage()); }

$nv = new challange($conn);

$id_ch = filter_input(INPUT_GET, 'id_ch', FILTER_VALIDATE_INT) ?: filter_input(INPUT_POST, 'id_ch', FILTER_VALIDATE_INT);

$old_data = $nv->getById($id_ch);

if (!$old_data) {
    header("Location: challenge.php?error=notfound");
    exit();
}

if(isset($_POST['update']))
{
    $id_user = $_POST['id_user'];
    $pass = $_POST['passe'];

    $rqt=$conn->prepare("SELECT * FROM user WHERE id=? AND mot_passe=?");
    $rqt->execute([$id_user, $pass]);
    
    if($rqt->fetch())
    {
        $res = $nv->modifier($id_ch, $_POST['titre'], $_POST['desc'], $_POST['cat'], $_POST['date']);
        
        if($res){
            header("Location: challenge.php?msg=update");
            exit();
        } else {
            echo "<script>alert('Erreur lors de la modification');</script>";
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
    <title>Modifier Challenge</title>
    <link rel="stylesheet" href="../view/style.css">
</head>
<body>
    <h2>Modifier le Challenge #<?php echo htmlspecialchars($id_ch); ?></h2>

    <form action="" method="post">
        <input type="hidden" name="id_ch" value="<?php echo $id_ch; ?>">

        <fieldset>
            <legend>Informations du Challenge</legend>
            <label>Titre:</label><br>
            <input type="text" name="titre" value="<?php echo htmlspecialchars($old_data['title']); ?>" required><br><br>

            <label>Description:</label><br>
            <textarea name="desc" required><?php echo htmlspecialchars($old_data['description']); ?></textarea><br><br>

            <label>Catégorie:</label><br>
            <input type="text" name="cat" value="<?php echo htmlspecialchars($old_data['category']); ?>" required><br><br>

            <label>Deadline:</label><br>
            <input type="date" name="date" value="<?php echo $old_data['deadline']; ?>" required><br><br>
        </fieldset>

        <br>
        <fieldset>
            <legend>Confirmation d'identité</legend>
            <label>L'identification de utilisateur:</label><br>
            <input type="text" name="id_user" placeholder="ID obligatoire..." required><br><br>

            <label>Mot de Passe:</label><br>
            <input type="password" name="passe" placeholder="Password obligatoire..." required><br><br>
        </fieldset>

        <input type="submit" name="update" value="Enregistrer les modifications" class="btn">
        <a href="challenge.php">Annuler</a>
    </form>
</body>
</html>