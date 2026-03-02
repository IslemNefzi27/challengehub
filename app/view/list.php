<?php
require_once '../../config/db.php';
require_once '../../app/models/submission.php';
$id_ch = $_GET['id'] ?? 1;
$submissions = getSubmissionsByChallenge($pdo, $id_ch);
?>
<h2>Liste des participations</h2>
<table border="1">
    <tr>
        <th>User</th>
        <th>Description</th>
        <th>Lien (sub_id)</th>
    </tr>
    <?php foreach ($submissions as $sub): ?>
    <tr>
        <td><?php echo htmlspecialchars($sub['username'] ?? 'Anonyme'); ?></td>
        <td><?php echo htmlspecialchars($sub['description']); ?></td>
        <td><a href="<?php echo htmlspecialchars($sub['sub_id']); ?>">Lien</a></td>
    </tr>
    <?php endforeach; ?>
</table>
