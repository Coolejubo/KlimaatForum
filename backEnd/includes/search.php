<?php
include_once '../../frontEnd/header.php';
include_once 'connection.php';
include_once 'showPostsFunctions.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

if (empty($search)) {
    header("Location: https://webtech-ki46.webtech-uva.nl/index.php");
    exit;
}

$search = $connection->real_escape_string($_GET['search']);
$result = $connection->query("SELECT * FROM posts 
WHERE postTitle LIKE '%$search%' OR postContent LIKE '%$search%' 
ORDER BY 
  CASE 
    WHEN postTitle LIKE '%$search%' THEN 1 
    ELSE 2 
  END, 
  postDate DESC
");
$result = mysqli_fetch_all($result, MYSQLI_NUM);

?>

<head>
    <link rel="stylesheet" href="https://webtech-ki46.webtech-uva.nl/frontEnd/homePage/home.css">
    <link rel="stylesheet" href="https://webtech-ki46.webtech-uva.nl/frontEnd/threads/posts.css">
</head>


<div class="pageBar">
    <a href="#" class="previous round">&#8249;</a>
    <a href="#" class="next round">&#8250;</a>
</div>


<div class="messages">
    <?php
    if(count($result) == 0){
        echo "No threads found";
    } else {
        showPosts($result, $connection);
    }
    ?>
</div>

<?php


$connection->close();
include_once '../../frontEnd/footer.php';
?>
