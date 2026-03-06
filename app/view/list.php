<?php
// app/views/submissions/list.php
require_once 'config/database.php';
// Gestion de la recherche
$search = $_GET['search'] ?? '';
if ($search) {
    $sql = "SELECT * FROM submissions WHERE id_ch = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$search]);
} else {
    $sql = "SELECT * FROM submissions ";
    $stmt = $pdo->query($sql);
}
$submissions = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Soumissions</title>
    <style>
        body { font-family: sans-serif; background: #f0f2f5; padding: 20px; }
        .container { max-width: 1000px; margin: auto; }
        h2 { text-align: center; color: #333; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background-color: #f8f9fa; color: #333; }
        a.link { color: #007bff; text-decoration: none; font-weight: bold; }
        a.link:hover { text-decoration: underline; }
        .add-btn { display: inline-block; background: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; margin-bottom: 20px; }
        .btn-edit { background: #ffc107; color: black; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 14px; }
        .btn-delete { background: #dc3545; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 14px; border: none; cursor: pointer; }
        .search-form { margin-bottom: 20px; text-align: right; }
        .search-form input { padding: 8px; border-radius: 4px; border: 1px solid #ddd; }
        .search-form button { padding: 8px 12px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Mes Participations</h2>
        
        <div style="display: flex; justify-content: space-between; align-items: center;">
        <a href="index.php?action=participer" class="add-btn">+ Nouvelle soumission</a>
            
        <form class="search-form" method="GET" action="index.php">
    <input type="hidden" name="action" value="lst">
    
    <input type="number" name="search" placeholder="Rechercher par ID Challenge" value="<?php echo htmlspecialchars($search); ?>">
    <button type="submit">Rechercher</button>
</form>
        </div>
        
        <?php if (empty($submissions)): ?>
            <p>Aucune soumission trouvée.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Challenge</th>
                        <th>Description</th>
                        <th>Lien du projet</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($submissions as $sub): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($sub['id_sub']); ?></td>
                        <td><strong>#<?php echo htmlspecialchars($sub['id_ch']); ?></strong></td>
                        <td><?php echo htmlspecialchars($sub['description']); ?></td>
                        <td>
                        <a href="<?= htmlspecialchars($sub['content_link'] ?? $sub['id_sub'] ?? '#'); ?>" target="_blank" class="link">
                                                        Voir
                                                    </a>
                                                </td>
                        <td>
                        <a href="index.php?action=edit_sub&id=<?= $sub['id_sub']; ?>" class="btn-edit">Modifier</a>
                        <a href="index.php?action=delete_sub&id=<?= $sub['id_sub']; ?>" class="btn-delete">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>