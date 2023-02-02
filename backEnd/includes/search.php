<?php
include_once '../../frontEnd/header.php';
include_once 'connection.php';
include_once 'showPostsFunctions.php';
include_once 'functions.inc.php';

$search = $_GET['search'];

$pageInfo = '&webPage=search&search='.$search;


if (empty($search)) {
    header("Location: https://webtech-ki46.webtech-uva.nl/index.php");
    exit;
}
//om SQL injection te voorkomen
if (invalidUsername($search)) {
    $result = [];
}
// Dit is de query voor de search, er de titel wordt eerst gematched
// op de search en daarna de content.
else {
    $search = $_GET['search'];
    $stmt = $connection->prepare("SELECT *, 
        IF(postTitle LIKE ?, 1, 2) AS titleMatch 
        FROM posts 
        WHERE postTitle LIKE '%".$search."%' OR postContent LIKE '%".$search."%' 
        ORDER BY titleMatch, postLikes DESC");
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();
    $result = mysqli_fetch_all($result, MYSQLI_NUM);
    $stmt->close();
}

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
