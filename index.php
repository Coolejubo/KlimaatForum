<?php 

    include_once 'frontEnd/header.php'

?>
<!-- include styling for this page. -->

<head>
    <link rel="stylesheet" href="https://webtech-ki46.webtech-uva.nl/frontEnd/homePage/home.css">
    <link rel="stylesheet" href="https://webtech-ki46.webtech-uva.nl/frontEnd/threads/posts.css">
</head>

<div class="pageFilters">
    <div class="pageBar">
        <a href="https://webtech-ki46.webtech-uva.nl?
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
        ?>
        " class="previous round">&#8249;</a>
        <a href="https://webtech-ki46.webtech-uva.nl?
        <?php
            if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    echo 'page='.($page + 1);
                } 
            else {
                    echo 'page=1';
                }
        ?>
        " class="next round">&#8250;</a>
    </div>
    <div class="postTypeDiv">   
        <?php
        $displayLatest = true;
        if (isset($_GET['displayLatest'])) {
            $displayLatest = $_GET['displayLatest'] === 'true';
        }
        ?>
        <form action="#">
        <select class="postType" onchange="window.location = 'https://webtech-ki46.webtech-uva.nl?displayLatest=' + (this.value === 'latest') + '&page=' + <?php echo isset($_GET['page']) ? $_GET['page'] : '0'; ?>">
            <option value="best" <?php echo isset($_GET['displayLatest']) && $_GET['displayLatest'] === 'false' ? 'selected' : ''; ?>>Best Posts</option>
            <option value="latest" <?php echo !isset($_GET['displayLatest']) || $_GET['displayLatest'] === 'true' ? 'selected' : ''; ?>>Latest Posts</option>
        </select>
        </form>
    </div>
</div>

<div class="messages">
    <?php 
    require_once 'backEnd/includes/showPostsFunctions.php';
    require_once 'backEnd/includes/connection.php';
    if (isset($_GET['displayLatest'])) {
        $displayLatest = $_GET['displayLatest'] === 'true';
    }

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if ($displayLatest) {
            $array = tenLatestPosts($connection, $page);
        } else {
            $array = tenBestPosts($connection, $page);
        }
    }
    else {
        if ($displayLatest) {
            $array = tenLatestPosts($connection, 0);
        } else {
            $array = tenBestPosts($connection, 0);
        }
    }
    showPosts($array, $connection);
    ?>
</div>

<?php 

    include_once 'frontEnd/footer.php'

?>        