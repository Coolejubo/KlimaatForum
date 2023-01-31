<?php

// DEBUG

// function pswMatch($psw, $pswrepeat) {

//     if ($psw === $pswrepeat) {
//         $result = true;
//         print('dit moet je wel zien');
//     } 
//     if ($psw !== $pswrepeat) {
//         $result = false;
//         print('dit moet je niet zien');
//     }
//     return $result;
// }

// $psw = 'bruh';
// $pswrepeat = 'bruh';
// $test = pswMatch($psw, $pswrepeat);
// print($test);

//debug om de functies te controleren

// $balzak = true;
// if ($balzak) {


//if statements die de gebruiker terugstuurd naar de signup pagina
if (isset($_POST['submit'])) {

    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $about = htmlspecialchars($_POST['about']);
    $psw = htmlspecialchars($_POST['password']);
    $pswrepeat = htmlspecialchars($_POST['psw-repeat']);

    // $username = 'aqui';
    // $email = 'aqui';
    // $psw = 'aqui';
    // $pswrepeat = $psw;
    
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
