<?php

function tenLatestPosts($connection) {
    $result = mysqli_query($connection, 'SELECT * FROM posts ORDER BY postDate LIMIT 10;');
    $result = mysqli_fetch_all($result, MYSQLI_NUM);
    return $result;
}

function showLatestPosts() {
    
    //maak connectie en haal de laatste 10 rijen op.
    require_once 'connection.php';
    $result = tenLatestPosts($connection);

    //maak een for loop die door alle post heen loopt en ze 
    // een voor een echod naar de html code.
    for ($x = 10; $x >= 0; $x--) {
        echo '<div class="messageBox">'; 
        echo    '<h1 class="messageTitel">';
        echo        $result[$x][2];          
        echo        '<a class="messageInfo">'.$result[$x][4].' '.$result[$x][0].'</a>';        
        echo    '</h1>';
        echo    '<p class="message">'.$result[$x][3].'</p>';
        echo '</div>';    
      } 
}

