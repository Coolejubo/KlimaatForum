<?php

session_start();

if (isset($_GET['webPage'])) {
    $page = $_GET['webPage'];
    if ($page == 'index'){
        $url = '?';
    }
    if ($page == 'userProfile') {
        $url = '/frontEnd/profilePage/userProfile.php?';
        $profileID = $_GET['profileID'];
        $url = $url.'userID='.$profileID;
    }
    if ($page == 'search') {
        $url = '/backEnd/includes/search.php?';
        $search = $_GET['search'];
        $url = $url.'search='.$search;
    }
}
if (isset($_GET['page'])) {
    $url = $url.'&page='.$_GET['page'];
}
if (isset($_GET['displayLatest'])){
    $latest = $_GET['displayLatest'];
    $url = $url.'&displayLatest='.$latest;
}

if (isset($_POST['submit'])) {


    $userID = $_SESSION['userID'];
    $postID = $_POST['postID'];

    require_once 'connection.php';
    require_once 'functions.inc.php';
    require_once 'showPostsFunctions.php';

    if (hasLiked($postID, $userID, $connection, 1)) {
        unlike($postID, $userID, 1, $connection);
        header("location: https://webtech-ki46.webtech-uva.nl".$url);
    }
    else {
        like($postID, $userID, 1, $connection);
        header("location: https://webtech-ki46.webtech-uva.nl".$url);
    }
} 

else {
    header("location: https://webtech-ki46.webtech-uva.nl".$url."");
}