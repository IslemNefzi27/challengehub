<?php
function addSubmission($conn, $challenge_id, $user_id, $description, $content_link) {
    $description = mysqli_real_escape_string($conn, $description);
    $content_link = mysqli_real_escape_string($conn, $content_link);
    $sql = "INSERT INTO submissions (id_ch, id_user, description, id_sub) 
            VALUES ('$challenge_id', '$user_id', '$description', '$content_link')";
    return mysqli_query($conn, $sql);
}
?>