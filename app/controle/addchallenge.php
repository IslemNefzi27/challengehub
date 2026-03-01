<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="challenge.php" method="post">
        <label for="">Titre</label>
        <input type="text" placeholder="Saisire le Titre de challange" name="titre">
        <br><br>
        <label for="">Description</label>
        <input type="text" name="des">
        <br><br>
        <label for="">Catégorie</label>
        <input type="text" name="categorie">
        <br><br>
        <label for="">Date Limite</label>
        <input type="datetime" name="date" id="">
        <br><br>
        <input type="submit" value="Add Challenge" name="ajouter">
        <input type="submit" value="Modifier Challenge" name="modifier">
    </form>
</body>
</html>