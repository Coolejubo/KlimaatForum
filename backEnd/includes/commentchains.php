<?php

    include_once 'connection.php';

    if(!isset($_GET['id'])) {
        exit('no id');
    }

    // functie om een reply chain te maken, dit is een lijst met alle replies op een comment
    function createReplyChain($parentID, $replies) {
        $reply_chain = array();
        foreach($replies as $reply) {
            if($reply['parentID'] == $parentID) {
                $children = createReplyChain($reply['responseID'], $replies);
                if(count($children) > 0) {
                    $reply['children'] = $children;
                }
                $reply_chain[] = $reply;
            }
        }
        return $reply_chain;
    }
    
    // maakt een array om alle comments in op te slaan
    $postID = (int) $_GET['id'];
    $result = $connection->query("SELECT r.responseID, r.parentID, r.responseContent, r.responseDate, r.postID, r.responseLikes, u.username FROM responses r JOIN users u ON r.userID = u.userID WHERE r.postID = '$postID' ORDER BY r.parentID, r.responseDate DESC");
    $replies = array();
    while($row = $result->fetch_assoc()) {
        $replies[] = array(
            "responseID" => $row['responseID'],
            "parentID" => $row['parentID'],
            "responseContent" => $row['responseContent'],
            "responseDate" => $row['responseDate'],
            "postID" => $row['postID'],
            "responseLikes" => $row['responseLikes'],
            "username" => $row['username']
        );
    }

    // maakt een reply chain voor alle top comments (comments op de post zelf)
    $reply_chains = createReplyChain(0, $replies);
    $connection->close();

?>