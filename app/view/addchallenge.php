<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Challange</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <form action="index.php?action=doInsertChallenge" method="post" class="form">
        <label for="">Titre</label>
        <input type="text" placeholder="Saisire le Titre de challange" name="titre" class="i"  required>
        <br><br>
        <label for="">Description</label>
        <textarea name="des" id="textarea" cols="30" rows="10"  class="i" placeholder="Description svp....."  required></textarea>
        <br><br>
        <label for="">Catégorie</label>
        <input type="text" name="categorie" placeholder="Catégorie svp .........." class="i" required>
        <br><br>
        <label for="">Date Limite</label>
        <input type="date" name="date" id="" class="i" required>
        <br><br>
        <input type="submit" value="Add Challenge" name="ajouter" class="btn">
    </form>
</body>
</html>