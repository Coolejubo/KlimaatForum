<?php

    session_start();

if (!isset($_SESSION["userID"])) {
    header("Location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/login.php");
    exit();

}

    require_once 'functions.inc.php';
    require_once 'connection.php';


    // verdeelt alle eigenschappen van een comment over de juiste variablen en sanitized de comments
    $responseContent = mysqli_real_escape_string($connection, $_POST['responseContent']);
    $postID = mysqli_real_escape_string($connection, $_POST['postID']);
    $userID = mysqli_real_escape_string($connection, $_SESSION['userID']);
    $parentID = mysqli_real_escape_string($connection, $_POST['parentID']);

    //bind parameters en insert data
    $stmt = $connection->prepare("INSERT INTO responses (responseContent, postID, userID, parentID) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siii", $responseContent, $postID, $userID, $parentID);
    $stmt->execute();
    $stmt->close();

    $connection->close();


    header("Location: https://webtech-ki46.webtech-uva.nl/frontEnd/threads/posts.php?id=" . $postID);
    exit();

?>