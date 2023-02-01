<?php

session_start();

if (isset($_POST['submit'])) {

    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $user_id = $_SESSION['userID'];

    require_once 'connection.php';
    require_once 'functions.inc.php';

    if (emptyInputsLogin($username, $email) !== false ) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/profilePage/profilePage.php?error=emptyInput');
        exit();
    }
    if (OtherUserExists($connection, $username, $email, $user_id) !== false ) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/profilePage/profilePage.php?error=usernameExists');
        exit();
    }
    if (!invalidEmail($email) and !invalidUsername($username)) {
        editUser($connection, $username, $email, $user_id);
    }
    else {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/profilePage/profilePage.php?error=invalidInput');
        exit();
    }
}
else {
    header('location: https://webtech-ki46.webtech-uva.nl');
}

