<?php
require_once '/var/www/html/backEnd/includes/connection.php';

if (isset($_POST['submit'])) {
    $query = "DELETE FROM posts WHERE postID=?";
    $postID = $_POST['postID'];
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 's', $postID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/profilePage/profilePage.php?error=deletesucces');
    exit();
}
?>
