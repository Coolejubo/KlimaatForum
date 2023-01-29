<?php

function tenLatestPosts($connection, $page) {
    // Deze functie returned de hoeveelheid paginas die er zijn
    // maximaal tien.
    if ($page > 0) {
        $offset = ($page * 10);
    } else {
        $offset = 0;
    }
    $result = mysqli_query($connection, 'SELECT * FROM posts ORDER BY postDate DESC LIMIT 10 OFFSET '.$offset.';');
    $result = mysqli_fetch_all($result, MYSQLI_NUM);
    return $result;
}

function tenBestPosts($connection, $page) {
    if ($page > 0) {
        $offset = ($page * 10);
    } else {
        $offset = 0;
    }
    $result = mysqli_query($connection, 'SELECT * FROM posts ORDER BY postLikes DESC LIMIT 10 OFFSET '.$offset.';');
    $result = mysqli_fetch_all($result, MYSQLI_NUM);
    return $result;
}

//DEBUG

// require_once 'connection.php';

// echo count(tenLatestPosts($connection, 1));

function fetchUsername($userID, $connection) {

    // Prepare and execute the SQL query
    $query = "SELECT username FROM users WHERE userID = ?;";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $userID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $username = mysqli_fetch_all($result, MYSQLI_NUM)[0][0];

    //close connections
    $stmt->close();

    return $username;
}

function showPosts($post, $connection) {

    $lim = count($post);
    
    //maak een for loop die door alrle post heen loopt en ze 
    // een voor een echod naar de html code.
    for ($x = 0; $x <= ($lim - 1); $x++) {
        ?>
        <div class="message-container">
            <div class="message-header">
                <h1 class="message-title"><?php echo $post[$x][2] ?></h1>
                <div class="message-meta">
                    <span class="username"><?php echo fetchUsername($post[$x][0], $connection) ?></span>
                    <span class="date"><?php echo date("d-m-Y H:i", $post[$x][4]) ?></span>
                    <img class="profilePic" src="https://api.multiavatar.com/<?php echo fetchUsername($post[$x][0], $connection) ?>.png?apikey=FgC5ls0LaUYoKd">
                </div>
            </div>
            <div class="message-content"><?php echo $post[$x][3] ?></div>
            <div class="message-footer">
                <div class="message-likes">
                    <?php
                    if (isset($_SESSION['userID'])) {
                        ?>
                        <form action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/like.inc.php" method="post" class="like-form">
                            <input type="hidden" name="postID" value="<?php echo $post[$x][1]?>">
                            <?php 
                                if (hasLiked($post[$x][1], $_SESSION['userID'], $connection, 1)) {
                                    ?>
                                    <input type="hidden" name="likeValue" value="unlike">
                                    <button type="submit" name="submit" class="unlike-btn"></button>
                                    <?php
                                } 
                                else {
                                    ?>
                                    <input type="hidden" name="likeValue" value="like">
                                    <button type="submit" name="submit" class="like-btn"></button>
                                    <?php
                                }
                            ?>
                        </form>
                    <?php 
                    }
                    ?>   
                    <span class="like-count">
                        <?php 
                            echo $post[$x][5];
                            if ($post[$x][5] == 1) {
                                echo ' Like';
                            }
                            else {
                                echo ' Likes';
                            }
                        ?> 
                    </span>
                </div>
                <a class="message-comments" href="https://webtech-ki46.webtech-uva.nl/frontEnd/threads/posts.php?id=<?php echo $post[$x][1] ?>" class="comments-btn">comments</a>
            </div>
        </div>
        <?php
    }
}

function hasLiked($postID, $userID, $connection, $isPost) {

    //bereid een query voor om uit de likes database een post te halen en te checken
    // of een gebruiker de post geliked heeft.

    $query = "SELECT * FROM likes WHERE userID = ? AND referenceID = ? AND post = ?;";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'iii', $userID, $postID, $isPost);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if (mysqli_fetch_assoc($resultData)) {
        $result = true;
        return $result;
    }
    if (!mysqli_fetch_assoc($resultData)) {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

//DEBUG

// require_once 'connection.php';

// if ((hasLiked(1, 1, $connection, 1) === true)) {
//     print('BRUH');
// }

