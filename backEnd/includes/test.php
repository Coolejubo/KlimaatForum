<?php
include_once 'showPostsFunctions.php';
include_once 'connection.php';

$query = "SELECT * FROM posts 
WHERE postTitle LIKE 'hallo' OR postContent LIKE 'hallo' 
ORDER BY CASE WHEN postTitle LIKE 'hallo' THEN 1 ELSE 2 END, 
postLikes DESC;";

$result = $connection->query($query);
$result = mysqli_fetch_all($result, MYSQLI_NUM);
print $result[0][3];
?>
