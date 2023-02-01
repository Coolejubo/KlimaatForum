<?php

function emptyInputsSignup($username, $email, $psw, $pswrepeat) {
    // Deze functie controleert of er lege invoervelden zijn bij de gebruiker tijdens het aanmaken van een account
    // Als er minstens één veld leeg is, retourneert de functie true.
    // Anders, retourneert de functie false.
    if (empty($username) || empty($email) || empty($psw) || empty($pswrepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}


function emptyInputsLogin($username, $psw) {
    // Deze functie controleert of de velden voor gebruikersnaam en wachtwoord in het inlogformulier leeg zijn
    // Als de gebruikersnaam of het wachtwoordveld leeg is, retourneer true, anders false
    if (empty($username) || empty($psw)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidUsername($username) {
    // Controleer of de gebruikersnaam alleen uit letters en cijfers bestaat
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        // Gebruikersnaam bevat niet-toegestane tekens, dus retourneer true
        return true;
    }
    else {
        // Anders retourneer je false
        return false;
    }
}

function invalidEmail($email) {
    // Deze functie controleert of het opgegeven email-adres geldig is
    // door gebruik te maken van de filter_var functie en de FILTER_VALIDATE_EMAIL optie.
    // Als het email-adres niet geldig is, wordt 'true' teruggegeven.
    // In andere gevallen wordt 'false' teruggegeven.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    else {
        return false;
    }
}

function pswMatch($psw, $pswrepeat) {
    //Deze functie controleert of de twee opgegeven wachtwoorden (herhalings controle)
    //gelijk aan elkaar zijn
    if ($psw == $pswrepeat) {
        //retourneer true als ze hetzelfde zijn
        $result = true;
    } else {
        //anders false
        $result = false;
    }
    return $result;
}

function userExists($connection, $username, $email) {
    // Deze functie controleert of er al een gebruiker in de database bestaat met dezelfde gebruikersnaam of hetzelfde e-mailadres
    //returnt false als die niet bestaat, de row van gevonden user als die wel bestaat.
    // Deze wordt gebruikt gebruikt voor zowel de login.php als signup.php. 
    // Er wordt gebruik gemaakt van statements om SQL injectie te voorkomen.
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

    if ($row = mysqli_fetch_assoc($resultData)) {
        return  $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}


function otherUserExists($connection, $username, $email, $user_id) {
    // Deze functie controleert of er al een andere gebruiker in de database bestaat met dezelfde gebruikersnaam of hetzelfde e-mailadres.
    //returnt false als die niet bestaat, de row van gevonden user als die wel bestaat.
    // Deze wordt gebruikt gebruikt voor het veranderen van profiel informatie 
    // Er wordt gebruik gemaakt van statements om SQL injectie te voorkomen.
    // gecontroleerd of er geen error komt van dat statement.

    $query = 'SELECT * FROM users WHERE (username = ? OR email = ?) AND userID != ?;';
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=smtm2Failed');
        exit();
    }

    mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $user_id);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return  $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($connection, $username, $email, $psw) {
    // Voeg de gebruiker toe aan de tabel "users" in de database
    // Maak gebruik van statements om SQL-injectie te voorkomen
    $query = 'INSERT INTO users (username, email, password) VALUES (?, ?, ?);';
    $stmt = mysqli_stmt_init($connection);

    // Controleer of er geen fout komt tijdens het prepareren van het statement
    if (!mysqli_stmt_prepare($stmt, $query)) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=smtmFailed');
        exit();
    }

    // Maak het wachtwoord veiliger door het te hashen
    $hashedPassword = password_hash($psw, PASSWORD_DEFAULT);
    
    // Bind de parameters aan het statement en voer het uit
    mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $hashedPassword);
    mysqli_stmt_execute($stmt);

    // Sluit het statement en stuur de gebruiker door naar de signup pagina met de melding "none"
    mysqli_stmt_close($stmt);
    header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=none');
    exit();
}

function createPost($connection, $title, $content, $userID) {
    //Haal UNIX tijd op (aantal seconden sinds 1970)
    $time = time();
    //Voorbereid de query
    $query = 'INSERT INTO posts (userID, postTitle, postContent, postDate) VALUES (?, ?, ?, ?);';
    $stmt = mysqli_prepare($connection, $query);

    //Controleer of het voorbereiden van de statement niet mislukt
    if (!mysqli_stmt_prepare($stmt, $query)) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/createPost/createPost.php?error=smtmFailed');
        exit();
    }

    //Voer de query uit
    mysqli_stmt_bind_param($stmt,"issi", $userID, $title, $content, $time);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location: https://webtech-ki46.webtech-uva.nl?error=none');
    exit();
}

function loginUser($connection, $username, $psw) {
    // Functie om inloggen van gebruiker te verifiëren
    // Controleert of gebruiker in database staat (zowel via gebruikersnaam als e-mail)
    $uidExists = userExists($connection, $username, $username);

    if ($uidExists === false) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/login.php?error=userInvalid');
        exit();
    }
    // Hasht ingevoerd wachtwoord en vergelijkt dit met opgeslagen hash in database
    $HashedPswDB = $uidExists['password'];
    $checkPsw = password_verify($psw, $HashedPswDB);

    // Stuurt gebruiker door naar startpagina bij succesvol inloggen, anders foutmelding via URL.
    if ($checkPsw === false) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/login.php?error=passwordInvalid');
        exit();
    }
    else if ($checkPsw === true) {
        session_start();
        $_SESSION['username'] = $uidExists['username'];
        $_SESSION['email'] = $uidExists['email'];
        $_SESSION['userID'] = $uidExists['userID'];
        header('location: https://webtech-ki46.webtech-uva.nl?session=started');
    }
}

function emptyInputsEdit($username, $email, $about) {
    //Controleer of er lege invoervelden zijn
    //Retourneer waar als er minimaal één veld leeg is
    //Anders retourneer onwaar
    if (empty($username) || empty($email) || empty($about)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}


function editUser($connection, $username, $email, $user_id) {
      // Check if the username exists in the database, if so, make it empty
        $username = mysqli_real_escape_string($connection, $username);
        $username_check_stmt = $connection->prepare("SELECT username FROM users WHERE username=?");
        $username_check_stmt->bind_param("s", $username);
        $username_check_stmt->execute();
        $username_check_result = $username_check_stmt->get_result();
        if (mysqli_num_rows($username_check_result) > 0) {
            $username = "";
        }
        $username_check_stmt->close();

        // Check if the email exists in the database, if so, make it empty
        $email = mysqli_real_escape_string($connection, $email);
        $email_check_stmt = $connection->prepare("SELECT email FROM users WHERE email=?");
        $email_check_stmt->bind_param("s", $email);
        $email_check_stmt->execute();
        $email_check_result = $email_check_stmt->get_result();
        if (mysqli_num_rows($email_check_result) > 0) {
            $email = "";
        }
        $email_check_stmt->close();
        
       // Check of beide inputvelden niet leeg zijn
        // Als dit zo is, update dan username en email in de database en sla deze op in de session (met SQL preparatie)
       if (!empty($username) and !empty($email)){
            $query = 'UPDATE users SET username = ?, email = ? WHERE userID = ?;';
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, 'ssi', $username, $email, $user_id);
            mysqli_stmt_execute($stmt);
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            mysqli_stmt_close($stmt);
        
            header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/profilePage/profilePage.php?error=none');
            exit();
       }

       // Check of het username veld niet leeg is
       // Als dit zo is, update dan de username in de database en sla deze op in de session (met SQL preparatie)
       if (!empty($username)) {
            $query = 'UPDATE users SET username = ? WHERE userID = ?;';
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, 'si', $username, $user_id);
            mysqli_stmt_execute($stmt);
            $_SESSION['username'] = $username;
            mysqli_stmt_close($stmt);
        
            header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/profilePage/profilePage.php?error=none');
            exit();
       }
       // Check of het email veld niet leeg is
       // Als dit zo is, update dan de email in de database en sla deze op in de session (met SQL preparatie)
       if (!empty($email)) {
            $query = 'UPDATE users SET email = ? WHERE userID = ?;';
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, 'si', $email, $user_id);
            mysqli_stmt_execute($stmt);
            $_SESSION['email'] = $email;
            mysqli_stmt_close($stmt);
        
            header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/profilePage/profilePage.php?error=none');
            exit();
       }
       //check of beiden velden leeg zijn, in dat geval stuur door met de error old_name_and_variable.
       //Er moet dezelfde waarden ingevoerd zijn voor beiden omdat het niet van een andere user kan zijn 
       //omdat we dat al checken in editProfile.inc.php en ze wel leeg zijn gemaakt
       if (empty($email) and empty($username)) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/profilePage/profilePage.php?error=old_name_and_variable');
        exit();
   }

}

function like($referenceID, $userID, $post, $connection) {
    //Met deze functie kan een user een post liken
    if ($post == 1) {
        //Voer de query uit(met sql injectie beveiliging) om de gebruiker als
        // "like" te markeren voor de post met $referenceID
        $query = "INSERT INTO likes (userID, referenceID, post) VALUES (?, ?, 1);";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 'ii', $userID, $referenceID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    
        //Voer de query uit(met sql injectie beveiliging)
        // om het aantal likes van de post met $referenceID te verhogen
        $query = "UPDATE posts SET postLikes = postLikes + 1 WHERE postID = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 'i', $referenceID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    
        return true;
    }
}
      
function unlike($referenceID, $userID, $post, $connection) {
    //Met deze functie kan een user een post unliken
    if ($post == 1) {
        //Voer de query uit(met sql injectie beveiliging) om de gebruiker, 
        //die als "like" staat gemarkeerd voor de post met $referenceID, te verwijderen
        $query = "DELETE FROM `likes` WHERE userID = ? AND referenceID = ? AND post = 1;";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 'ii', $userID, $referenceID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Voor de query uit (met sql injectie beveiliging)
        // om het aantal likes van de post met $referenceID te verlagen
        $query = "UPDATE posts SET postLikes = postLikes - 1 WHERE postID = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 'i', $referenceID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return true;
    }
}


function displayComments($comments, $postID) {
    // Deze functie geeft de opmerkingen weer
    // Er is een reeks opmerkingen en de postID als parameters nodig
    // Het doorloopt de opmerkingen en geeft ze weer
    // Als een opmerking kinderen heeft, roept het zichzelf op om de kinderen weer te geven
    foreach ($comments as $comment) {
        echo '<div class="parent-comment">';
        echo '<p>' . $comment['responseContent'] . '</p>';
        echo '<p>' . $comment['username'] . '</p>';
        echo '<p>' . $comment['responseDate'] . '</p>';
        echo '<p>' . $comment['postID'] . '</p>';
        echo '<form action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/createComment.inc.php" method="post">';
        echo '<label for="responseContent">reply:</label>';
        echo '<br>';
        echo '<textarea id="responseContent" name="responseContent"></textarea>';
        echo '<br>';
        echo '<input type="hidden" id="postID" name="postID" value="'.$postID.'">';
        echo '<input type="hidden" id="parentID" name="parentID" value="'.$comment['responseID'].'">';
        echo '<input type="submit" value="Submit">';
        echo '</form>';
        if(!empty($comment['children'])) {
            echo '<div class="children-comments">';
            displayComments($comment['children'], $postID);
            echo '</div>';
        }
        echo '</div>';
    }
}


?>