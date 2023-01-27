<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Post</title>
    </head>

    <body>
        <?php
        if (!isset($_GET['id'])) {
            exit('no id');
        }

        $postID = (int) $_GET['id'];

        include_once '../../backEnd/includes/connection.php';

        if (!$connection) {
            exit('no conccection');
        }

        if (!($query = mysqli_prepare($connection, "SELECT postTitle, postContent FROM posts WHERE postID=?"))) {
            exit('Error preparing query');
        }

        if (!$query->bind_param("i", $postID)) {
            exit('Error binding params');

        }

        if (!$query->execute()) {
            exit('Error executing query');
        
        }

        $query->bind_result($postTitle, $postContent);

        $query->fetch();

        $query->close();


        include '../header.php';

        ?>
        <style>
        <?php include 'posts.css'; ?>
        </style>

        

     
         
        <div class="threadBox">
        <h1 class="threadTitle"> <?php echo $postTitle; ?> </h1>
        <p><?php echo $postContent; ?></p>
        </div>

        <form action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/createComment.inc.php" method="post">
        <label for="responseContent" class="commentBoxLabel">comment:</label>
        <textarea id="responseContent" name="responseContent" class="commentBox" rows="5"></textarea>
        <br>
        <input type="hidden" id="parentID" name="parentID" value="0">
        <input type="hidden" id="postID" name="postID" value="<?php echo $postID; ?>">
        <input type="submit" value="Submit" class="commentBoxLabel">
        </form>

        <?php 
        include_once '../../backEnd/includes/commentchains.php';
        function displayComments($reply_chains, $postID) {
            foreach ($reply_chains as $comment) {
                echo '<div class="parent-comment">';
                echo '<p>' . $comment['responseContent'] . '</p>';
                echo '<p>' . $comment['username'] . '</p>';
                echo '<p>' . $comment['responseDate'] . '</p>';
                echo '<p>' . $comment['postID'] . '</p>';
                echo '<form action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/createComment.inc.php" method="post">';
                echo '<label for="responseContent">reply:</label>';
                echo '<br>';
                echo '<textarea id="responseContent" name="responseContent"></textarea>';
                echo '<br>';
                echo '<input type="hidden" id="postID" name="postID" value="'.$postID.'">';
                echo '<input type="hidden" id="parentID" name="parentID" value="'.$comment['responseID'].'">';
                echo '<input type="submit" value="Submit">';
                echo '</form>';
        
                if(!empty($comment['children'])) {
                    echo '<div class="children-comments">';
                    displayComments($comment['children'], $postID);
                    echo '</div>';
                }
                echo '</div>';
            }
        }
        
        ?>



        <div class="comments">
            <?php displayComments($reply_chains, $postID); ?>
        </div>

        <script src="js/posts.js"></script>
    
        <?php


        include '../footer.php'

        


        ?>
    </body>
</html>