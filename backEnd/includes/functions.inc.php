<?php

function emptyInputsSignup($username, $email, $psw, $pswrepeat) {
    if (empty($username) || empty($email) || empty($psw) || empty($pswrepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function emptyInputsLogin($username, $psw) {

    if (empty($username) || empty($psw)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidUsername($username) {

    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        return true;
    }
    else {
        return false;
    }
}

function invalidEmail($email) {

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    else {
        return false;
    }
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


function otherUserExists($connection, $username, $email, $user_id) {
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

//DEBUG

// include 'connection.php';

// userExists($connection, 'huuba', 'hallo@kut.nl');

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
    header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php?error=none');
    exit();
}

function createPost($connection, $title, $content, $userID) {

    //time in UNIX (seconden vanaf 1970)
    $time = time();
    //Prepare Query
    $query = 'INSERT INTO posts (userID, postTitle, postContent, postDate) VALUES (?, ?, ?, ?);';
    $stmt = mysqli_prepare($connection, $query);

    //check if the statement doesnt fail
    if (!mysqli_stmt_prepare($stmt, $query)) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/createPost/createPost.php?error=smtmFailed');
        exit();
    }

    //execute query

    mysqli_stmt_bind_param($stmt,"issi", $userID, $title, $content, $time);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location: https://webtech-ki46.webtech-uva.nl?error=none');
    exit();

}

function loginUser($connection, $username, $psw) {
    // check of de gebruiker in de database staat
    // gebruiker kan beide user en email invullen!
    $uidExists = userExists($connection, $username, $username);

    if ($uidExists === false) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/login.php?error=userInvalid');
        exit();
    }

    $HashedPswDB = $uidExists['password'];

    $checkPsw = password_verify($psw, $HashedPswDB);

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
    if (empty($username) || empty($email) || empty($about)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}


function editUser($connection, $username, $email, $user_id) {
       // Check if username exists in database, if so make it empty
       $username_check_query = "SELECT username FROM users WHERE username='$username'";
       $username_check_result = mysqli_query($connection, $username_check_query);
       if (mysqli_num_rows($username_check_result) > 0) {
           $username = "";
       }
   
       // Check if email exists in database , if so make it empty
       $email_check_query = "SELECT email FROM users WHERE email='$email'";
       $email_check_result = mysqli_query($connection, $email_check_query);
       if (mysqli_num_rows($email_check_result) > 0) {
           $email = "";
       }
   
       // Update values if they are not empty
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
       if (empty($email) and empty($username)) {
        header('location: https://webtech-ki46.webtech-uva.nl/frontEnd/profilePage/profilePage.php?error=Sameinput');
        exit();
   }

}

function like($referenceID, $userID, $post, $connection) {
    
    if ($post == 1) {
        //insert like into likes
        $query = "INSERT INTO likes (userID, referenceID, post) VALUES ($userID, $referenceID, 1);";
        mysqli_query($connection, $query);

        //update like amount in the posts database
        $query = "UPDATE posts SET postLikes = postLikes + 1 WHERE postID = $referenceID";
        return mysqli_query($connection, $query);
    }
}

function unlike($referenceID, $userID, $post, $connection) {
    
    if ($post == 1) {
        // remove like
        $query = "DELETE FROM `likes` WHERE userID = $userID AND referenceID = $referenceID AND post = 1;";
        mysqli_query($connection, $query);

        //update like amount in the posts database
        $query = "UPDATE posts SET postLikes = postLikes - 1 WHERE postID = $referenceID";
        return mysqli_query($connection, $query);
    }
}



function displayComments($comments, $postID) {
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


// DEBUG

// require_once 'connection.php';

// unlike(11, 27, 1, $connection);