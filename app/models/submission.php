<?php
function addSubmission($pdo, $id_ch, $id_user, $description, $sub_id) {
    $sql = "INSERT INTO submissions (id_ch, id_user, description, sub_id) 
            VALUES (:id_ch, :id_user, :description, :sub_id)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':id_ch'       => $id_ch,
        ':id_user'     => $id_user,
        ':description' => $description,
        ':sub_id'      => $sub_id
    ]);
}
?>
