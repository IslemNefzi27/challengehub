<?php
$id_ch = $_GET['id'] ?? 1;
?>
<form action="../../app/controllers/submissioncontroller.php" method="POST">
    <input type="hidden" name="action" value="submit">
    <input type="hidden" name="id_ch" value="<?php echo htmlspecialchars($id_ch); ?>">
    <label>Description :</label><br>
    <textarea name="description" required></textarea><br><br>
    <label>Lien de soumission (sub_id) :</label><br>
    <input type="url" name="sub_id" required placeholder="https://..."><br><br>
    <button type="submit">Envoyer</button>
</form>
