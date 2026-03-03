<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Challange</title>
    <link rel="stylesheet" href="../../public/css/style.css">
  </head>
  <body>
    <form action="addchallenge.php" method="post">
      <input type="submit" value="Créer un Nouvous Challange" name="creerch" class="btn"/>
      <input type="submit" value="Deconnecter" name="deconnecter" class="btn">
    </form>
    <?php
    require_once '../models/modeladdchallenge.php';
    require_once '../../config/database.php';
    $conn = Database::getInstance();
    $nouveauchallange=new challange($conn);
    if(isset($_POST['ajouter']))
    {
      $nouveauchallange->ajouter($_POST['titre'], $_POST['des'], $_POST['categorie'], $_POST['date']);
      header("Location: addchallenge.php?success=1");
      exit();
    }
    $liste = $nouveauchallange->afficher_challenge();
    if(isset($_GET['success']))
    {
      echo '<p>Défi ajouté avec succès!</p>';
    }
    //l'affichage
            if(empty($liste)) {
              echo '<h3>Aucun défi trouvé.</h3>';
          } else {
              foreach($liste as $ch) {
                  $titre = htmlspecialchars($ch['title']);
                  $cat = htmlspecialchars($ch['category']);
                  $desc = htmlspecialchars($ch['description']);
                  echo "<div class='ch'> 
                  <h3>" . $titre . "</h3> 
                  <p>" . $desc . "</p> 
                  <p>" . $cat . "</p> 
                  <p>" . $ch['deadline'] . "</p> 
                  
                  <a href='participer.php' class='btn'>participer</a> 
                  <a href='../controle/comment_view.php?id_ch=" . $ch['id_ch'] . "' class='btn'>comment_view</a>
                  <a href='../controle/supperimer.php?id_ch=" . $ch['id_ch'] . "' class='supp'>supperimer</a>
                  <a href='../controle/modifier.php?id_ch=" . $ch['id_ch'] . "' class='btn'>Modifier Challenge</a>
                </div>";
              }}
      ?>
  </body>
</html>
