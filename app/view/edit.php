<?php
// app/views/submissions/edit.php
require_once '../../../config/db.php';

// 1. Récupérer l'ID de la soumission via l'URL
$id = $_GET['id'] ?? null;
if (!$id) die("ID manquant");

// 2. Récupérer les données actuelles depuis la table
<<<<<<< HEAD
$stmt = $pdo->prepare ("SELECT * FROM submissions WHERE id_sub = ?");
=======
$stmt = $pdo->prepare("SELECT * FROM submissions WHERE id_sub = ?");
>>>>>>> 7175a58cd776a8cbd0bc687425b485baad26f08e
$stmt->execute([$id]);
$sub = $stmt->fetch();

if (!$sub) die("Soumission non trouvée");

// 3. Traitement du formulaire après clic sur "Mettre à jour"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'];
    $content_link = $_POST['content_link']; // On récupère le nouveau lien

    // Correction de la requête : On change la description et le lien, pas l'ID !
    $sql = "UPDATE submissions SET description = ?, content_link = ? WHERE id_sub = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$description, $content_link, $id]);

    header("Location: list.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier la participation</title>
    <style>
        body { font-family: sans-serif; background: #f0f2f5; padding: 20px; }
        .container { max-width: 500px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input, textarea { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background: #ffc107; color: black; padding: 12px; border: none; width: 100%; margin-top: 20px; cursor: pointer; border-radius: 4px; font-weight: bold; }
        button:hover { background: #e0a800; }
        .back { display: block; text-align: center; margin-top: 15px; color: #666; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Modifier la soumission #<?php echo htmlspecialchars($id); ?></h2>
        
        <form method="POST">
            <label>Description :</label>
            <input type="text" name="description" maxlength="30" value="<?php echo htmlspecialchars($sub['description']); ?>" required>
            
            <label>Lien du projet (content_link) :</label>
            <input type="url" name="content_link" value="<?php echo htmlspecialchars($sub['content_link']); ?>" required>
            
            <button type="submit">Enregistrer les modifications</button>
        </form>
        
        <a href="list.php" class="back">Annuler</a>
    </div>
</body>
</html>
