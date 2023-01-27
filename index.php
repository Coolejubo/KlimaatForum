<?php 

    include_once 'frontEnd/header.php'

?>
<!-- include styling for this page. -->
<head>
    <link rel="stylesheet" href="https://webtech-ki46.webtech-uva.nl/frontEnd/homePage/home.css">
    <link rel="stylesheet" href="https://webtech-ki46.webtech-uva.nl/frontEnd/threads/posts.css">
</head>
<div class="pageBar">
    <a href="#" class="previous round">&#8249;</a>
    <a href="#" class="next round">&#8250;</a>
</div>

<?php 

    require_once 'backEnd/includes/showPostsFunctions.php';
    require_once 'backEnd/includes/connection.php';
    $array = tenLatestPosts($connection);
    showPosts($array, $connection);

?>

<?php 

    include_once 'frontEnd/footer.php'

?>        