<?php

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $psw = $_POST['password'];

    require_once 'connection.php';
    require_once 'functions.inc.php';

    if (emptyInputsLogin($username, $psw) !== false ) { 
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/login.php?error=emptyInput');
        exit();
    }
    
    loginUser($connection, $username, $psw);
    
} 
else {
    header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/login.php');
    exit();
}