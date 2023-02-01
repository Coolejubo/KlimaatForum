<?php


// Controleer of het formulier is verzonden
if (isset($_POST['submit'])) {

    // Maak schoon en bewaar de invoer van het formulier
    $username = $_POST['username'];
    $email = $_POST['email'];
    $psw = $_POST['password'];
    $pswrepeat = $_POST['psw-repeat'];
    
    //Voeg de connection and functions bestanden toe
    require_once 'connection.php';
    require_once 'functions.inc.php';

    // Controleren op lege invoer en doorsturen met fout
    if (emptyInputsSignup($username, $email, $psw, $pswrepeat) !== false ) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=emptyInput');
        exit();
    }
    // Controleren op password match en doorsturen met fout
    if (pswMatch($psw, $pswrepeat) === false) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=pswsDontMatch');
        exit();
    }
    // Controleren op valide username en doorsturen met fout
    if (invalidUsername($username) === true) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=invalidUser');
        exit();
    }
    // Controleren op valide email en doorsturen met fout
    if (invalidEmail($email) === true) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=invalidEmail');
        exit();
    }
    // Controleren of de username al bestaat en zo jadoorsturen met fout
    if (userExists($connection, $username, $email) !== false ) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=usernameExists');
        exit();
    }

    createUser($connection, $username, $email, $psw);
}
else {
    header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php');
}

?>
