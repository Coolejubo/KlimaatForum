<?php

function emptyInputsSignup($username, $email, $psw, $pswrepeat) {

    if (empty($username) || empty($email) || empty($psw) || empty($pswrepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function pswMatch($psw, $pswrepeat) {

    if ($psw == $pswrepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function userExists($connection, $username, $email) {

    // Deze lines worden gebruikt voor zowel de login.php als signup.php. 
    // Er wordt gebruik gemaakt van statements om SQL injectie te voorkomen.
    // IPV de input van de gebruiker gelijk te injecteren wordt eerst 
    // gecontroleerd of er geen error komt van dat statement.


    $query = 'SELECT * FROM users WHERE username = ? OR email = ?;';
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=smtm1Failed');
        exit();
    }

    mysqli_stmt_bind_param($stmt, 'ss', $username, $email);
    mysqli_stmt_execute($stmt);


    $resultData = mysqli_stmt_get_result($stmt);

    //DEBUG 

    // De query hieronder werkt.

    // $rowprint = mysqli_fetch_assoc($resultData);
    // print($rowprint['email'].$rowprint['password']);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return  $row;
    }
    else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

//DEBUG

include 'connection.php';

userExists($connection, 'huuba', 'hallo@kut.nl');

function createUser($connection, $username, $email, $psw) {

    $query = 'INSERT INTO users (username, email, password) VALUES (?, ?, ?);';
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=smtmFailed');
        exit();
    }

    $hashedPassword = password_hash($psw, PASSWORD_DEFAULT);
    
    mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $hashedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location: https://webtech-ki46.webtech-uva.nl');
    exit();
}

// DEBUG

// if (emptyInputsSignup('asf','sadf','bruh','sd')) {
//     print('Deze is fout');
// }
// else {
//     print('Deze is goed');
// }


// $test1 = 'bruh';
// $test2 = $test1;

// if ((pswMatch($test1, $test2 ) === false)) {
//     print('Deze is fout');
// }
// if ((pswMatch($test1, $test2) === true)) {
//     print('Deze is goed');
// }
// else {
//     print('Iets Anders');
// }