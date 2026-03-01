<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Challange</title>
</head>
<body>
    <form action="challenge.php" method="post">
        <label for="">Titre</label>
        <input type="text" placeholder="Saisire le Titre de challange" name="titre" required>
        <br><br>
        <label for="">Description</label>
        <<textarea name="des" id="" cols="30" rows="10" required></textarea>
        <br><br>
        <label for="">Catégorie</label>
        <input type="text" name="categorie" required>
        <br><br>
        <label for="">Date Limite</label>
        <input type="datetime" name="date" id="" required>
        <br><br>
        <input type="submit" value="Add Challenge" name="ajouter">
    </form>
</body>
</html>