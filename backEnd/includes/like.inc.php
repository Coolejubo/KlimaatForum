<?php

session_start();

if (isset($_POST['submit'])) {

    $userID = $_SESSION['userID'];
    $postID = $_POST['postID'];

    require_once 'connection.php';
    require_once 'functions.inc.php';
    require_once 'showPostsFunctions.php';

    if (hasLiked($postID, $userID, $connection, 1)) {
        unlike($postID, $userID, 1, $connection);
        header("location: https://webtech-ki46.webtech-uva.nl?status=liked");
    }
    else {
        like($postID, $userID, 1, $connection);
        header("location: https://webtech-ki46.webtech-uva.nl?status=unliked");
    }
} 

else {
    header("location: https://webtech-ki46.webtech-uva.nl");
}