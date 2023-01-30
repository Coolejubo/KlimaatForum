<?php

    require_once '/var/www/html/frontEnd/header.php';
    require_once '/var/www/html//backEnd/includes/connection.php';
    require_once '/var/www/html//backEnd/includes/showPostsFunctions.php';
    
    $user_id = $_GET['userID'];
    $profilename = fetchUsername($user_id, $connection);

    function echoGetUID($user_id){
        echo '&userID='.$user_id;
    }

?>

<head>
    <link rel="stylesheet" href="https://webtech-ki46.webtech-uva.nl/frontEnd/profilePage/editProfile.css">
    <link rel="stylesheet" href="https://webtech-ki46.webtech-uva.nl/frontEnd/homePage/home.css">
    <link rel="stylesheet" href="https://webtech-ki46.webtech-uva.nl/frontEnd/threads/posts.css">
</head>

<div class="user-info">
    <img class="profile_Pic" src="https://api.multiavatar.com/<?php echo $profilename ?>.png?apikey=FgC5ls0LaUYoKd">        
    <form action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/editProfile.inc.php" method="post">
        <div class="user-details">
            <h1>Username</h1>
            <p class="user_name"><?php echo $profilename ?></p>
        </div>
    </form>
</div>

<?php
    $displayLatest = true;
    if (isset($_GET['displayLatest'])) {
        $displayLatest = $_GET['displayLatest'] === 'true';
    }
?>

<div class="pageFilters">
    <div class="pageBar">
        <a href="https://webtech-ki46.webtech-uva.nl/frontEnd/profilePage/userProfile.php?
            <?php 
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                if ($page <= 0){
                    echo 'page=0';
                } 
                else {
                echo 'page='.($page - 1);
                }
            } 
            else {
                echo 'page=0';
            }
            echo '&displayLatest=' . ($displayLatest ? 'true' : 'false');
            echoGetUID($user_id);
            ?>
        " class="previous round">&#8249;</a>


        <?php
        $postCount = getPostCount($connection);
        if (!isset($_GET['page']) || $_GET['page'] + 1 < ceil($postCount / 10)) {
        ?>
            <a href="https://webtech-ki46.webtech-uva.nl/frontEnd/profilePage/userProfile.php?
            <?php
                if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        echo 'page='.($page + 1);
                    } 
                else {
                        echo 'page=1';
                    }
                echo "&displayLatest=".($displayLatest ? 'true' : 'false');
                echoGetUID($user_id);
            ?>
            " class="next round">&#8250;</a>
        <?php
        }
        ?>
    </div>

    <div class="postTypeDiv">   
        <form action="#">
        <select class="postType" onchange="window.location = 'https://webtech-ki46.webtech-uva.nl/frontEnd/profilePage/userProfile.php?displayLatest=' + (this.value === 'latest') + '&page=' + <?php echo isset($_GET['page']) ? $_GET['page'] : '0';?> + '&userID=' + <?php echo isset($_GET['userID']) ? $_GET['userID'] : '0';?>">
            <option value="best" <?php echo isset($_GET['displayLatest']) && $_GET['displayLatest'] === 'false' ? 'selected' : ''; ?>>Best Posts</option>
            <option value="latest" <?php echo !isset($_GET['displayLatest']) || $_GET['displayLatest'] === 'true' ? 'selected' : ''; ?>>Latest Posts</option>
        </select>
        </form>
    </div>
</div>

<div class="messages">
    <?php 

    if (isset($_GET['displayLatest'])) {
        $displayLatest = $_GET['displayLatest'] === 'true';
    }

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if ($displayLatest) {
            $array = userTenLatestPosts($connection, $user_id, $page);
        } else {
            $array = userTenBestPosts($connection, $user_id, $page);
        }
    }
    else {
        if ($displayLatest) {
            $array = userTenLatestPosts($connection,$user_id, 0);
        } else {
            $array = userTenBestPosts($connection, $user_id, 0);
        }
    }
    showPosts($array, $connection);
    ?>
</div>

<?php

require_once '../footer.php';

?>
