<?php

    session_start();

if (!isset($_SESSION["userID"])) {
    header("Location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/login.php");
    exit();

}

    require_once 'functions.inc.php';
    require_once 'connection.php';


    // verdeelt alle eigenschappen van een comment over de juiste variablen en sanitized de comments
    $responseContent = htmlspecialchars($_POST['responseContent']);
    $postID = htmlspecialchars($_POST['postID']);
    $userID = $_SESSION["userID"];
    $parentID = htmlspecialchars($_POST['parentID']);

    // voegt de comment toe aan de database
    $connection->query("INSERT INTO responses (responseContent, postID, userID, parentID) VALUES ('$responseContent', '$postID', '$userID', '$parentID')");

    $connection->close();

    header("Location: https://webtech-ki46.webtech-uva.nl/frontEnd/threads/posts.php?id=" . $postID);
    exit();

?>