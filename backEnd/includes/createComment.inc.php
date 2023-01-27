<?php

    session_start();

if (!isset($_SESSION["userID"])) {
    header("Location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/login.php");
    exit();

}

    require_once 'functions.inc.php';
    require_once 'connection.php';

    $responseContent = $_POST['responseContent'];
    $postID = $_POST['postID'];
    $userID = $_SESSION["userID"];
    $parentID = $_POST['parentID'];

    $connection->query("INSERT INTO responses (responseContent, postID, userID, parentID) VALUES ('$responseContent', '$postID', '$userID', '$parentID')");

    $connection->close();

    header("Location: https://webtech-ki46.webtech-uva.nl/frontEnd/threads/posts.php?id=" . $postID);
    exit();
    // huub stinkt

?>