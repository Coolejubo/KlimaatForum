<?php

require_once '/var/www/html/backEnd/includes/connection.php';

if (!$connection) {
    exit('no conccection');
}

if(isset($_POST['update_profile'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $about = $_POST['about'];
    $id = $_SESSION['userID'];

    $query = "UPDATE users SET username = '$username', email = '$email', about = '$about' WHERE userID = '$id'";
    return mysqli_query($connection, $query);
}
?>
