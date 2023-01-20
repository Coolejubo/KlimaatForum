<?php

    session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Environmental Forum</title>
        <link rel="stylesheet" href="https://webtech-ki46.webtech-uva.nl/frontEnd/style.css">
        <link rel="stylesheet" href="https://webtech-ki46.webtech-uva.nl/frontEnd/homePage/home.css">
        <link rel="stylesheet" href="https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/login.css">
    </head>
    <body>
        <div class="header">
                <img src="img/logo2.png" alt="">
            <h1>Enviromental Forum</h1>
        </div>

        <div class="topnav">
            <a href="https://webtech-ki46.webtech-uva.nl">Home</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
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
