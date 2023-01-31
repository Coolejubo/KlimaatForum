<?php
include '../header.php'; 
include_once '../../backEnd/includes/connection.php';

if (!isset($_GET['id'])) {
    header("location: https://webtech-ki46.webtech-uva.nl?error=noPostId");
    exit('no id');
}

$postID = (int) $_GET['id'];

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
?>

<head>
    <link rel="stylesheet" href="posts.css">
</head>
       
<div class="threadBox">
    <h1 class="threadTitle"> <?php echo $postTitle; ?> </h1>
    <p><?php echo $postContent; ?></p>
</div>

        <form action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/createComment.inc.php" method="post" class="commentForm">
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
                echo '<p class="responseDate">' . $comment['responseDate'] . '</p>';
                echo '<p class="responseUser"> ' . $comment['username'] . '</p>';
                echo '<p class="responseContent">' . $comment['responseContent'] . '</p>';
                echo '<button class="reply-button">Reply</button>';
                echo '<form style="display:none;" class="replyForm" action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/createComment.inc.php" method="post">';
                echo '<br>';
                echo '<textarea id="responseContent" name="responseContent" class="responseBox"></textarea>';
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

        <script>
            document.querySelectorAll(".reply-button").forEach(function(button){
                button.addEventListener("click", function(){
                    this.nextElementSibling.style.display = "block";
                });
            });

            const form = document.querySelector(".commentForm");
            form.addEventListener("submit", function(event){
                const responseContent = form.elements["responseContent"].value;
                if (!responseContent) {
                    alert("Comment cannot be empty");
                    event.preventDefault();
                }
            });

            const repform = document.querySelector(".replyForm");
            repform.addEventListener("submit", function(event){
                const represponseContent = repform.elements["responseContent"].value;
                if (!represponseContent) {
                    alert("Comment cannot be empty");
                    event.preventDefault();
                }
            });
        </script>
    
<?php

include '../footer.php'

?>