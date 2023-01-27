<?php

    include_once 'connection.php';

    if(!isset($_GET['id'])) {
        exit('no id');
    }

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
    
    $postID = (int) $_GET['id'];
    $result = $connection->query("SELECT r.responseID, r.parentID, r.responseContent, r.responseDate, r.postID, u.username FROM responses r JOIN users u ON r.userID = u.userID WHERE r.postID = '$postID' ORDER BY r.parentID, r.responseID");
    $replies = array();
    while($row = $result->fetch_assoc()) {
        $replies[] = array(
            "responseID" => $row['responseID'],
            "parentID" => $row['parentID'],
            "responseContent" => $row['responseContent'],
            "responseDate" => $row['responseDate'],
            "postID" => $row['postID'],
            "username" => $row['username']
        );
    }
    $reply_chains = createReplyChain(0, $replies);
    $connection->close();

?>