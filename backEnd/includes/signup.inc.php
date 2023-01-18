<?php

//if statements die de gebruiker terugstuurd naar de signup pagina

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pswrepeat = $_POST['psw-repeat'];
    
    require_once 'connection.php';
    require_once 'funcions.inc.php';

    if (emptyInputsSignup($username, $email, $password, $pswrepeat) !== false ) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=emptyInput');
        exit();
    }
    if (invalidUsername($username) !== false ) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=InvalidUsername');
        exit();
    }
    if (invalidEmail($username) !== false ) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=InvalidEmail');
        exit();
    }
    if (pswMatch($password, $pswrepeat) !== false ) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=passwordsDontMatch');
        exit();
    }
    if (userExists($connection, $username) !== false ) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=usernameExists');
        exit();
    }

    createUser($username, $email, $password);
}
else {
    header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php');
}