<?php

function tenLatestPosts($connection) {
    $result = mysqli_query($connection, 'SELECT * FROM posts ORDER BY postDate LIMIT 10;');
    $result = mysqli_fetch_all($result, MYSQLI_NUM);
    return $result;
}

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
    
    //maak een for loop die door alle post heen loopt en ze 
    // een voor een echod naar de html code.
    for ($x = ($lim - 1); $x >= 0; $x--) {
        echo '<div class="messageBox"'; 
        echo        '<h1>'.$post[$x][2].'</h1>';
        echo        '<p>'.fetchUsername($post[$x][0], $connection).'</p>';  
        echo        '<p>'.date("d-m-Y H:i", $post[$x][4]).'</p>';
        echo        '<p>'.$post[$x][3].'</p>';

        if (isset($_SESSION['userID'])) {
            ?>
            <form action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/like.inc.php" method="post">
                <input type="hidden" name="postID" value="<?php echo $post[$x][1]?>">
                <?php 
                    if (hasLiked($post[$x][1], $_SESSION['userID'], $connection, 1)) {
                        ?>
                        <input type="hidden" name="likeValue" value="unlike">
                        <button type="submit" name="submit">Unlike</button>
                        <?php
                    } 
                    else {
                        ?>
                        <input type="hidden" name="likeValue" value="like">
                        <button type="submit" name="submit">Like</button>
                        <?php
                    }
                    ?>
                <span class="like-count"><?php echo $post[$x][5]; ?></span>
            </form>

            <?php 
        }
        echo '<a href="https://webtech-ki46.webtech-uva.nl/frontEnd/threads/posts.php?id='.$post[$x][1].'">comments</a>';
        echo '</div>';
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

