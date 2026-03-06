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
        input[type="number"], input[type="url"], input[type="text"], textarea { width: 100%; padding: 12px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        textarea { resize: vertical; height: 100px; }
        button { width: 100%; background-color: #28a745; color: white; padding: 12px; border: none; border-radius: 5px; margin-top: 25px; font-size: 16px; cursor: pointer; transition: background 0.3s; font-weight: bold; }
        button:hover { background-color: #218838; }
        
        /* Nouveau style pour le lien vers la liste */
        .footer-link { display: block; text-align: center; margin-top: 20px; text-decoration: none; color: #007bff; font-weight: 500; font-size: 14px; }
        .footer-link:hover { text-decoration: underline; color: #0056b3; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Ma Participation</h2>
    
<<<<<<< HEAD
    <form action="index.php?action=doInsertSubmission" method="POST">
=======
    <form action="../../controllers/submissioncontroller.php" method="POST">
>>>>>>> 7175a58cd776a8cbd0bc687425b485baad26f08e
        <label for="id_ch">ID du Challenge :</label>
        <input type="number" name="id_ch" id="id_ch" required placeholder="Ex: 1">

        <label for="description">Description (max 30 car.) :</label>
        <input type="text" name="description" id="description" maxlength="30" required placeholder="Décrivez brièvement votre solution...">

        <label for="content_link">Lien du projet (URL) :</label>
        <input type="url" name="content_link" id="content_link" required placeholder="https://github.com/...">

        <button type="submit">Envoyer la soumission</button>
    </form>
<<<<<<< HEAD
    
=======

>>>>>>> 7175a58cd776a8cbd0bc687425b485baad26f08e
    <a href="list.php" class="footer-link">← Voir toutes les participations</a>
</div>

</body>
</html>