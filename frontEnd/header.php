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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" 
     type="image/png" 
     href="https://webtech-ki46.webtech-uva.nl/frontEnd/logowebsite.png">
</head>

<div id="cookie-consent">
    <div id="cookie-consent-content">
        <p>"When you visit our website, we store small text files called cookies on your device. 
            These cookies help us remember your preferences and activities on our website.
            This way, we can provide you with a more personalized experience when you visit our website again.
            Please note that some of these cookies may be temporary and will be deleted when you close your browser,
            while others may be permanent and will stay on your device until they expire or you delete them manually. 
            Some of these cookies may also be set by other websites that you visit while on our website.
            We value your privacy and we want to be transparent about our use of cookies.
            By using our website, you consent to our use of cookies as described above."</p>
        <button id="cookie-consent-agree">Agree</button>
</div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    if (!localStorage.getItem("cookie-consent")) {
      document.getElementById("cookie-consent").style.display = "block";
    }
  });
  
  document.getElementById("cookie-consent-agree").addEventListener("click", function() {
    localStorage.setItem("cookie-consent", "true");
    document.getElementById("cookie-consent").style.display = "none";
  });
</script>
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
    <form action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/search.php" method="get">
        <input class="searchBar" type="text" name="search" placeholder="Search..">
    </form>
</div>



