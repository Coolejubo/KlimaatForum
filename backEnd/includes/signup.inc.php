<?php


// Controleer of het formulier is verzonden
if (isset($_POST['submit'])) {

    // Maak schoon en bewaar de invoer van het formulier
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $about = htmlspecialchars($_POST['about']);
    $psw = htmlspecialchars($_POST['password']);
    $pswrepeat = htmlspecialchars($_POST['psw-repeat']);
    
    //Voeg de connection and functions bestanden toe
    require_once 'connection.php';
    require_once 'functions.inc.php';

    if (emptyInputsSignup($username, $email, $psw, $pswrepeat) !== false ) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=emptyInput');
        exit();
    }
    if (pswMatch($psw, $pswrepeat) === false) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=pswsDontMatch');
        exit();
    }
    if (invalidUsername($username) === true) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=invalidUser');
        exit();
    }
    if (invalidEmail($username) === true) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=invalidEmail');
        exit();
    }
    if (userExists($connection, $username, $email) !== false ) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=usernameExists');
        exit();
    }

    createUser($connection, $username, $email, $about, $psw);
}
else {
    header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php');
}

?>
