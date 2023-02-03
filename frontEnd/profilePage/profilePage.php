<?php

    include_once '../header.php';

?>

<head>
    <link rel="stylesheet" href="https://webtech-ki46.webtech-uva.nl/frontEnd/profilePage/editProfile.css">
    <link rel="stylesheet" href="https://webtech-ki46.webtech-uva.nl/frontEnd/homePage/home.css">
    <link rel="stylesheet" href="https://webtech-ki46.webtech-uva.nl/frontEnd/threads/posts.css">
    <script src="editProfile.js"></script>
    <style>
        body{
            background-image: none;
            background-color: rgb(103, 169, 181);
        }
    </style>
</head>

<div class="user-info">
    <img class="profile_Pic" src="https://api.multiavatar.com/<?php echo $_SESSION['username'] ?>.png?apikey=FgC5ls0LaUYoKd">        
    <form action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/editProfile.inc.php" method="post">
        <div class="user-details">
            <h1>Username</h1>
            <p class="user_name"><?php echo $_SESSION['username'] ?></p>
            <h2>Email</h1>
            <p class="email"><?php echo $_SESSION['email'] ?></p>
        </div>
        <div class="edit-form" style="display: none;">
            <h1>Username</h1>
            <input type="text" class="usernameInput" name="username" placeholder="<?php echo $_SESSION['username'] ?>">
            <h1>Email</h1>
            <input type="text" class="emailEdit" name="email" placeholder="<?php echo $_SESSION['email'] ?>">
            <button type="submit" name="submit">Save</button>
        </div>
    </form>
</div>

<div class="editButtonDiv">
    <button class="edit-button">Edit</button>
</div>

<div class="errorMessage">
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyInput") {
            echo "<p>Please fill in all fields!<?p>";
        }
        else if ($_GET["error"] == "usernameExists") {
            echo "<p>This username or email has already been used.</p>";
        }
        else if ($_GET["error"] == "invalidInput") {
            echo "<p>This username or email contains characters that are not allowed.</p>";
        }
        else if ($_GET["error"] == "smtmFailed") {
            echo "<p>Something went wrong with the SQL statement when adding a user.</p>";
        }
        else if ($_GET["error"] == "none") {
            echo "<p>Saved succesfully!<?p>";
        }
    }
    ?>
</div>

<?php
    $displayLatest = true;
    if (isset($_GET['displayLatest'])) {
        $displayLatest = $_GET['displayLatest'] === 'true';
        }
?>

<div class="pageFilters">
    <div class="pageBar">
        <a href="https://webtech-ki46.webtech-uva.nl/frontEnd/profilePage/profilePage.php?
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
            ?>
        " class="previous round">&#8249;</a>

        <?php
        require_once '/var/www/html/backEnd/includes/showPostsFunctions.php';
        require_once '/var/www/html/backEnd/includes/connection.php';
        $postCount = getPostCount($connection);
        if (!isset($_GET['page']) || $_GET['page'] + 1 < ceil($postCount / 10)) {
        ?>
            <a href="https://webtech-ki46.webtech-uva.nl/frontEnd/profilePage/profilePage.php?
            <?php
                if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        echo 'page='.($page + 1);
                    } 
                else {
                        echo 'page=1';
                    }
                echo "&displayLatest=".($displayLatest ? 'true' : 'false');
            ?>
            " class="next round">&#8250;</a>
        <?php
        }
        ?>

    </div>
    <div class="postTypeDiv">   
        <form action="#">
        <select class="postType" onchange="window.location = 'https://webtech-ki46.webtech-uva.nl/frontEnd/profilePage/profilePage.php?displayLatest=' + (this.value === 'latest') + '&page=' + <?php echo isset($_GET['page']) ? $_GET['page'] : '0'; ?>">
            <option value="best" <?php echo isset($_GET['displayLatest']) && $_GET['displayLatest'] === 'false' ? 'selected' : ''; ?>>Best Posts</option>
            <option value="latest" <?php echo !isset($_GET['displayLatest']) || $_GET['displayLatest'] === 'true' ? 'selected' : ''; ?>>Latest Posts</option>
        </select>
        </form>
    </div>
</div>

<div class="messages">
    <?php 
    require_once '/var/www/html/backEnd/includes/showPostsFunctions.php';
    require_once '/var/www/html/backEnd/includes/connection.php';
    $id = $_SESSION['userID'];

    if (isset($_GET['displayLatest'])) {
        $displayLatest = $_GET['displayLatest'] === 'true';
    }

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if ($displayLatest) {
            $array = userTenLatestPosts($connection, $id, $page);
        } else {
            $array = userTenBestPosts($connection, $id, $page);
        }
    }
    else {
        if ($displayLatest) {
            $array = userTenLatestPosts($connection,$id, 0);
        } else {
            $array = userTenBestPosts($connection, $id, 0);
        }
    }
    showUserPosts($array, $connection);
    ?>
</div>

<?php
    include_once '../footer.php';
?>
