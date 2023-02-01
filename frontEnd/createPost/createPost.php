<?php 

    include_once '../header.php'

?>

<head>
    <link rel="stylesheet" href="https://webtech-ki46.webtech-uva.nl/frontEnd/createPost/createPost.css">
</head>

<div class="createPost">

    <form action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/createPost.inc.php" method="post">
            <input type="text" class="titleArea" name="title" placeholder="Title">
            <br>
            <textarea class="contentArea" name="content" rows="10" cols="30" placeholder="Content"></textarea> 
            <br>
            <button type="submit" class="postButton" name="submit">Post</button>
    </form>
        
    <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyInput") {
                echo "<p>Fill in all fields!<?p>";
            }
        }
    ?>
    
</div>


<?php 

    

    include_once '../footer.php'

?>