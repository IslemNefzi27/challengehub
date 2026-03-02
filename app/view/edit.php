<?php
// app/views/submissions/edit.php
require_once '../../../config/db.php';

$id = $_GET['id'] ?? null;
if (!$id) die("ID manquant");

// Récupérer les données actuelles
$stmt = $pdo->prepare("SELECT * FROM submissions WHERE id_sub = ?");
$stmt->execute([$id]);
$sub = $stmt->fetch();

if (!$sub) die("Soumission non trouvée");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'];
    $sub_id = $_POST['sub_id'];

    $sql = "UPDATE submissions SET description = ?, sub_id = ? WHERE id_sub = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$description, $sub_id, $id]);

    header("Location: list.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier</title>
    <style>
        body { font-family: sans-serif; background: #f0f2f5; padding: 20px; }
        .container { max-width: 500px; margin: auto; background: white; padding: 20px; border-radius: 8px; }
        input, textarea { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        button { background: #ffc107; color: black; padding: 10px; border: none; width: 100%; margin-top: 15px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Modifier la soumission #<?php echo $id; ?></h2>
        <form method="POST">
            <label>Description :</label>
            <textarea name="description" required><?php echo htmlspecialchars($sub['description']); ?></textarea>
            
            <label>Lien du projet :</label>
            <input type="url" name="sub_id" value="<?php echo htmlspecialchars($sub['sub_id']); ?>" required>
            
            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</body>
</html>