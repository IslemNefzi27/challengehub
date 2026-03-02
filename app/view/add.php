<?php
$challenge_id = isset($_GET['id']) ? $_GET['id'] : 1;
?>
<h2>Soumettre votre participation</h2>
<form action="../../app/controllers/SubmissionController.php" method="POST">
    <input type="hidden" name="action" value="submit">
    <input type="hidden" name="challenge_id" value="<?php echo htmlspecialchars($challenge_id); ?>">
    <label>Description de votre solution :</label><br>
    <textarea name="description" required></textarea><br><br>
    <label>Lien vers votre travail (GitHub, Image, etc.) :</label><br>
    <input type="url" name="content_link"><br><br>
    <input type="submit" value="Envoyer">
</form>