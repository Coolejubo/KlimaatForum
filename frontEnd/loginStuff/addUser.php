<?php
include '../../backEnd/connection.php';

// Create connection
// $conn = new PDO("mysql:host=$servername;dbname=$database;charset=utf8",$username, $password);

// Check connection
// if ($conn->connect_error) {
   // die("Connection failed: " . $conn->connect_error);
// }

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

// Escape user inputs for security
$username = $conn->quote($_REQUEST['username']);
$email = $conn->quote($_REQUEST['email']);
$password = $conn->quote($_REQUEST['password']);

// Hash and salt the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Attempt insert query execution
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

$query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
$stmt = $conn->prepare($query);
$stmt->bindParam(':username', $_REQUEST['username']);
$stmt->bindParam(':email', $_REQUEST['email']);
$stmt->bindParam(':password', $_REQUEST['password']);
$stmt->execute();

// Close connection
$conn = null;
?>