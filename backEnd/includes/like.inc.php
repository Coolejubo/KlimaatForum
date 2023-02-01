<?php

// Start een sessie
session_start();

// Controleer of het formulier is ingediend
if (isset($_POST['submit'])) {

    // Haal de gegevens uit de sessie en het formulier
    $userID = $_SESSION['userID'];
    $postID = $_POST['postID'];

    // Voeg de benodigde bestanden toe
    require_once 'connection.php';
    require_once 'functions.inc.php';
    require_once 'showPostsFunctions.php';

    // Controleer of de gebruiker al heeft geliked, zo ja, unlike dan
    if (hasLiked($postID, $userID, $connection, 1)) {
        unlike($postID, $userID, 1, $connection);
        exit();
    }
    // Als de gebruiker nog niet heeft geliked, like dan
    else {
        like($postID, $userID, 1, $connection);
        exit();
    }
} 
// Als het formulier niet is ingediend, ga terug naar de pagina
else {
    header("location: https://webtech-ki46.webtech-uva.nl".$url."");
    exit();
}

