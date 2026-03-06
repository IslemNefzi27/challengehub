<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Challenge</title>
    <link rel="stylesheet" href="public/css/style.css">
  </head>
  <body>
  <div style="margin: 20px 0;" class='b'>
    <form action="index.php?action=showAddForm" method="post">
      <input type="submit" value="Créer un Nouveau Challenge" name="creerch" class="btn"/>
    </form>

    <form action="index.php?action=logout" method="post">
      <input type="submit" value="Deconnecter" name="deconnecter" class="btn">
      <br/>
    </form>
   
     <form action="index.php?action=profile" method="post">
      <input type="submit" value="Mon_Profil" name="Mon Profil" class="btn"/>
    </form>
</div>
    <?php


    if(isset($_GET['success'])) {
      echo '<p style="color: green;">Défi ajouté avec succès!</p>';
    }
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
                  <p><strong>Catégorie:</strong> " . $cat . "</p> 
                  <p><strong>Deadline:</strong> " . $ch['deadline'] . "</p> 
                  <div class='b'>
                  <a href='index.php?action=participer&id_ch=" . $ch['id_ch'] . "' class='btn'>participer</a> 
                  <a href='index.php?action=view_comments&id_ch=" . $ch['id_ch'] . "' class='btn'>commenter</a>
                  <a href='index.php?action=delete_ch&id_ch=" . $ch['id_ch'] . "' class='supp' onclick='return confirm(\"Sûr?\")'>supprimer</a>
                  <a href='index.php?action=edit_ch&id_ch=" . $ch['id_ch'] . "' class='btn'>Modifier Challenge</a>
                  <a href='index.php?action=ranking&id_ch=" . $ch['id_ch'] . "' class='btn'>Vote</a>
                  </div>
                </div>";
        }
    }
    ?>
  </body>
</html>