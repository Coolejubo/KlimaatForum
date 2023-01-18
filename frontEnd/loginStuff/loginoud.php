<?php
// Connect to the database
include '../../backEnd/connection.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

// Check if the user has submitted the form
if(isset($_POST['submit'])) {
    // Retrieve the user's input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL statement
    $query = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $result = $stmt->fetch();

    // Check if the query returned a result
    if($result) {
        // Start a new session or resume existing session
        session_start();
        // Store the user's information in a session variable
        $_SESSION['user'] = $result;
        // Redirect the user to the welcome page
        header("Location: welcome.php");
    }
    else {
        // If the query didn't return a result, display an error message
        echo "Invalid username or password";
    }
}
?>