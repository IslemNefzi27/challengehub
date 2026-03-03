<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Soumettre ma participation</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background-color: #f0f2f5; padding: 40px; display: flex; justify-content: center; }
        .form-container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 500px; }
        h2 { color: #333; text-align: center; margin-bottom: 25px; }
        label { display: block; margin-top: 15px; font-weight: bold; color: #555; }
        input[type="number"], input[type="url"], textarea { width: 100%; padding: 12px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        textarea { resize: vertical; height: 100px; }
        button { width: 100%; background-color: #28a745; color: white; padding: 12px; border: none; border-radius: 5px; margin-top: 25px; font-size: 16px; cursor: pointer; transition: background 0.3s; }
        button:hover { background-color: #218838; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Ma Participation</h2>
    <form action="../../controllers/submissioncontroller.php" method="POST">
        <label for="id_ch">ID du Challenge :</label>
        <input type="number" name="id_ch" id="id_ch" required placeholder="Ex: 1">

        <label for="description">Description :</label>
        <textarea name="description" id="description" required placeholder="Décrivez votre solution..."></textarea>

        <label for="sub_id">Lien du projet (URL) :</label>
        <input type="url" name="sub_id" id="sub_id" required placeholder="https://github.com/...">

        <button type="submit">Envoyer la soumission</button>
    </form>
</div>

</body>
</html>
