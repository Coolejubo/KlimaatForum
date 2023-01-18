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

    $username = $_POST['username'];
    $email = $_POST['email'];
    $psw = $_POST['password'];
    $pswrepeat = $_POST['psw-repeat'];

    // $username = 'aqui';
    // $email = 'aqui';
    // $psw = 'aqui';
    // $pswrepeat = $psw;
    
    include 'connection.php';
    include 'functions.inc.php';

    if (emptyInputsSignup($username, $email, $psw, $pswrepeat) !== false ) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=emptyInput');
        exit();
    }
    if (pswMatch($psw, $pswrepeat) === false) {
        print('hallo');
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=pswsDontMatch');
        exit();
    }
    if (userExists($connection, $username, $email) !== false ) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=usernameExists');
        exit();
    }

    createUser($connection, $username, $email, $psw);
}
else {
    header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/login.php');
}
