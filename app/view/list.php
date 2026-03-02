<?php
$submissions = getSubmissionsByChallenge($conn, $_GET['id']);
?>
<h3>Participations</h3>
<?php if (empty($submissions)): ?>
    <p>Aucune participation pour le moment.</p>
<?php else: ?>
    <ul>
        <?php foreach ($submissions as $sub): ?>
            <li>
                <strong><?php echo $sub['username']; ?></strong> a posté : 
                <?php echo $sub['description']; ?>
                <?php if (!empty($sub['content_link'])): ?>
                    (<a href="<?php echo $sub['content_link']; ?>" target="_blank">Voir le travail</a>)
                <?php endif; ?>
                <br>
                <small>Posté le : <?php echo $sub['created_at']; ?></small>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>