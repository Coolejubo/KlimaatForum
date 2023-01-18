<?php
// Start a new session or resume existing session
session_start();

// Check if the user is logged in
if(isset($_SESSION['user'])) {
    // Retrieve the user's information from the session variable
    $user = $_SESSION['user'];

    // Display a welcome message
    echo "Welcome, " . $user['username'] . "!";
}
else {
    // If the user is not logged in, redirect them to the login page
    header("Location: login.php");
}
?>