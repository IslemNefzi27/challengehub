<?php
// app/views/submissions/delete.php
require_once '../../../config/db.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM submissions WHERE id_sub = ?");
    $stmt->execute([$id]);
}

header("Location: list.php");
exit();
?>