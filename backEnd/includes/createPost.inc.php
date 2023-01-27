<?php
// start a session
session_start();

//DEBUG
// $balzak = true;
// if ($balzak){

if (isset($_POST['submit'])) {
    require_once 'functions.inc.php';
    require_once 'connection.php';

    //DEBUG
    // $title = 'test';
    // $content = 'test';
    // $userID = 999;

    //grab data
    $title = htmlspecialchars($_POST["title"]);
    $content = htmlspecialchars($_POST["content"]);
    $userID = htmlspecialchars($_SESSION["userID"]);

    //we gebruiken de login functie, omdat die ook twee inputs heeft.
    if (emptyInputsLogin($title, $content) === true) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/createPost/createPost.php?error=emptyInput');
        exit();
    }

    //creeert een post.
    createPost($connection, $title, $content, $userID);
}
else {
    header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/createPost/createPost.php');
}
?>


