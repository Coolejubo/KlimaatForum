<?php
// Haal de tien laatste posts op uit de database, met paginering
function tenLatestPosts($connection, $page) {
     // bereken de offset op basis van het paginanummer
    if ($page > 0) {
        $offset = ($page * 10);
    } else {
        $offset = 0;
    }
    // Voer de query uit en haal de resultaten op uit de database
    $result = mysqli_query($connection, 'SELECT * FROM posts ORDER BY postDate DESC LIMIT 10 OFFSET '.$offset.';');
    $result = mysqli_fetch_all($result, MYSQLI_NUM);
    // Return het resultaat
    return $result;
}

// Haal de tien best beoordeelde posts op uit de database, met paginering
function tenBestPosts($connection, $page) {
    // bereken de offset op basis van het paginanummer
    if ($page > 0) {
    $offset = ($page * 10);
    } else {
    $offset = 0;
    }
    // Voer de query uit en haal de resultaten op uit de database
    $result = mysqli_query($connection, 'SELECT * FROM posts ORDER BY postLikes DESC LIMIT 10 OFFSET '.$offset.';');
    $result = mysqli_fetch_all($result, MYSQLI_NUM);
    // Return het resultaat
    return $result;
    }
    
    

// functie om de 10 laatste berichten van een specifieke gebruiker uit de database op te halen, met paginering
function userTenLatestPosts($connection, $userID, $page) {
    // bereken de offset op basis van het paginanummer
    if ($page > 0) {
        $offset = ($page * 10);
    } else {
        $offset = 0;
    }
    // Voer de query uit en haal de resultaten op uit de database
    $result = mysqli_query($connection, "SELECT * FROM posts WHERE userID = '$userID' ORDER BY postDate DESC LIMIT 10 OFFSET ".$offset.';');
    $result = mysqli_fetch_all($result, MYSQLI_NUM);
    // return het resultaat
    return $result;
}

// functie om de 10 beste berichten van een specifieke gebruiker uit de database op te halen, met paginering
function userTenBestPosts($connection, $userID, $page) {
    // bereken de offset op basis van het paginanummer
    if ($page > 0) {
        $offset = ($page * 10);
    } else {
        $offset = 0;
    }
    // Voer de query uit en haal de resultaten op uit de database
    $result = mysqli_query($connection, "SELECT * FROM posts WHERE userID = '$userID' ORDER BY postLikes DESC LIMIT 10 OFFSET ".$offset. ";");
    $result = mysqli_fetch_all($result, MYSQLI_NUM);
    // return het resultaat
    return $result;
}

// Haal de gebruikersnaam op van een specifieke gebruiker
function fetchUsername($userID, $connection) {
    // Prepareer en voer de SQL query uit
    $query = "SELECT username FROM users WHERE userID = ?;";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $userID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $username = mysqli_fetch_all($result, MYSQLI_NUM)[0][0];

    // Sluit de verbinding
    $stmt->close();

    // return de username
    return $username;
}


/* Deze functie laat posts zien */
function showPosts($post, $connection, $pageinfo) {

    $lim = count($post);
    
    //maak een for loop die door alle post heen loopt en ze 
    // een voor een echod naar de html code.
    for ($x = 0; $x <= ($lim - 1); $x++) {
        ?>
        <div class="message-container">
            <div class="message-header">
                <h1 class="message-title"><?php echo $post[$x][2] ?></h1>
                <div class="message-meta">
                    <!-- haal username, de profielfoto en de datum v.d post op en laat de datum in het juiste formaat zien -->
                    <span class="username"><?php echo fetchUsername($post[$x][0], $connection) ?></span>
                    <span class="date"><?php echo date("d-m-Y H:i", $post[$x][4]) ?></span>
                    <a href="https://webtech-ki46.webtech-uva.nl/frontEnd/profilePage/userProfile.php?userID=<?php echo $post[$x][0] ?>">
                        <img class="profilePic" src="https://api.multiavatar.com/<?php echo fetchUsername($post[$x][0], $connection) ?>.png?apikey=FgC5ls0LaUYoKd">
                    </a>
                </div>
            </div>
            <div class="message-content">
                <?php 
                    // Als de post langer is dan 1000 karakters, 
                    //toon dan slechts de eerste 1000 karakters en geef aan dat
                    // er meer te lezen is door op "comments" te klikken
                    if (strlen($post[$x][3]) > 1000) {
                        for ($i = 0; $i < 1000; $i++) {
                            echo $post[$x][3][$i];
                        }
                        ?>
                        <p style="color: darkgray;">Click on comments to read more</p>
                        <?php
                    }
                    //anders toon de hele post
                    else { 
                        echo $post[$x][3];
                    }
                ?>
            </div>
            <div class="message-footer">
                <div class="message-likes">
                    <?php
                    // Als de gebruiker ingelogd is, laat dan een like-formulier zien waarin de gebruiker de post kan liken of unliken
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
                                <span class="like-count" id="likes-<?php echo $post[$x][1]; ?>">
                                    <?php 
                                    // Laat zien hoeveel likes de post heeft en of het "like" of "likes" is
                                        echo $post[$x][5];
                                        if ($post[$x][5] == 1) {
                                            echo ' Like';
                                        }
                                        else {
                                            echo ' Likes';
                                        }
                                    ?> 
                                </span>
                            </form>

                    <?php 
                    }
                    ?> 

                </div>
                <!--Laat een knop zien voor "comments" die de gebruiker naar de comment pagina stuurt-->
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



/*
Deze functie(getPostCount) gebruikt een SQL-query om het aantal posts in de database te tellen.
Het resultaat wordt opgeslagen in een associatieve array en het aantal wordt geretourneerd.
*/
function getPostCount($connection) {
    $query = "SELECT COUNT(postId) as count FROM posts"; // selecteer het aantal posts
    $result = mysqli_query($connection, $query); // voer de query uit
    $count = mysqli_fetch_assoc($result)['count']; // sla het resultaat op in een associatieve array
    return $count; // return het aantal
    }

/* Deze functie laat posts zien die specifiek van een bepaalde user zijn */
function showUserPosts($post, $connection) {

    $lim = count($post);
    
    //maak een for loop die door alrle post heen loopt en ze 
    // een voor een echod naar de html code.
    for ($x = 0; $x <= ($lim - 1); $x++) {
        ?>
        <div class="message-container">
            <div class="message-header">
                <h1 class="message-title"><?php echo $post[$x][2] ?></h1>
                <div class="message-meta">
                    <!-- haal username, de profielfoto en de datum v.d post op en laat de datum in het juiste formaat zien -->
                    <span class="username"><?php echo fetchUsername($post[$x][0], $connection) ?></span>
                    <span class="date"><?php echo date("d-m-Y H:i", $post[$x][4]) ?></span>
                    <img class="profilePic" src="https://api.multiavatar.com/<?php echo fetchUsername($post[$x][0], $connection) ?>.png?apikey=FgC5ls0LaUYoKd">
                </div>
    </div>
            <div class="message-content">
                <?php 
                    // Als de post langer is dan 1000 karakters, 
                    //toon dan slechts de eerste 1000 karakters en geef aan dat
                    // er meer te lezen is door op "comments" te klikken
                    if (strlen($post[$x][3]) > 1000) {
                        for ($i = 0; $i < 1000; $i++) {
                            echo $post[$x][3][$i];
                        }
                        ?>
                        <p style="color: darkgray;">Click on comments to read more</p>
                        <?php
                    }
                    //anders toon de hele post
                    else { 
                        echo $post[$x][3];
                    }
                ?>
            </div>
            <div class="message-footer">
                <div class="delete-btn">
                    <form action='delete.php' method="post">
                        <input type="hidden" name="postID" value="<?php echo $post[$x][1] ?>">
                        <input type="submit" name="submit" value="Delete">
                    </form>
                </div>
                <div class="message-likes">
                    <span class="like-count" id="likes-<?php echo $post[$x][1]; ?>">
                        <?php 
                            // Laat zien hoeveel likes de post heeft en of het "like" of "likes" is
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
                <!--Laat een knop zien voor "comments" die de gebruiker naar de comment pagina stuurt-->
                <a class="message-comments" href="https://webtech-ki46.webtech-uva.nl/frontEnd/threads/posts.php?id=<?php echo $post[$x][1] ?>" class="comments-btn">comments</a>
            </div>
        </div>
        <?php
    }

}



