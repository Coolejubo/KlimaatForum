<?php

    session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <title>The Catalysts for Change</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://webtech-ki46.webtech-uva.nl/frontEnd/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@500&display=swap" rel="stylesheet">
</head>

<body>

<div class="topnav">
    <a class="logo" href="https://webtech-ki46.webtech-uva.nl">
        <img src="https://webtech-ki46.webtech-uva.nl/frontEnd/logowebsite.png">
    </a>
    <a href="https://webtech-ki46.webtech-uva.nl">The Catalysts for Change</a>
    <a href="https://webtech-ki46.webtech-uva.nl/frontEnd/about/about.php">About</a>
    <?php 
    if (isset($_SESSION['username'])) {
        echo '<a href="https://webtech-ki46.webtech-uva.nl/frontEnd/profilePage/profilePage.php">Profile</a>';
        echo '<a href="https://webtech-ki46.webtech-uva.nl/frontEnd/createPost/createPost.php">Post</a>';
        echo '<a href="https://webtech-ki46.webtech-uva.nl/backEnd/includes/logout.inc.php">Log out</a>';
    } 
    else {
        echo '<a href="https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/login.php">Log in</a>';
        echo '<a href="https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php">Sign Up</a>';

    }
    ?>
    <input class="searchBar" type="text" placeholder="Search..">
</div>


