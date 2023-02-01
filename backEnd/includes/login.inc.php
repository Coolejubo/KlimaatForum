<?php
// Controleer of de submit-knop is ingedrukt
if (isset($_POST['submit'])) {

    // Haal de ingevoerde gebruikersnaam en wachtwoord op uit de $_POST-array
    $username = $_POST['username'];
    $psw = $_POST['password'];

    // Sluit de vereiste bestanden in
    require_once 'connection.php';
    require_once 'functions.inc.php';

    // Controleer of de ingevoerde gebruikersnaam en wachtwoord leeg zijn
    if (emptyInputsLogin($username, $psw) !== false ) { 
        // Redirect naar inlogpagina met foutmelding 'emptyInput' als ze leeg zijn
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/login.php?error=emptyInput');
        exit();
    }
    // Controleer of de ingevoerde gebruikersnaam geen geldig e-mailadres is
    if (invalidEmail($username)) {
        // Controleer of de ingevoerde gebruikersnaam geen geldige gebruikersnaam is
        if(invalidUsername($username)){
            // Redirect naar inlogpagina met foutmelding 'invalidUser' als geen van beiden geldig is
            header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/login.php?error=invalidUser');
            exit();
        }
    }
    // Controleer of de ingevoerde gebruikersnaam geen geldige gebruikersnaam is
    if (invalidUsername($username)) {
        // Controleer of de ingevoerde gebruikersnaam geen geldig e-mailadres is
        if(invalidEmail($username)){
            // Redirect naar inlogpagina met foutmelding 'invalidUser' als geen van beiden geldig is
            header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/login.php?error=invalidUser');
            exit();
        }
    }
    // Meld de gebruiker aan met de ingevoerde gebruikersnaam en wachtwoord
    loginUser($connection, $username, $psw);
    
} 
// Als de submit-knop niet is ingedrukt
else {
    // Redirect terug naar inlogpagina
    header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/login.php');
    exit();
}

