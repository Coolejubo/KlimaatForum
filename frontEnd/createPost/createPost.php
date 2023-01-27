<?php 

    include_once '../header.php'

?>

<div class="createPost">

    <form action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/createPost.inc.php" method="post">
            <input type="text" id="title" name="title" placeholder="Title">
            <textarea name="content" rows="10" cols="30" placeholder="Content"></textarea> 
            <button type="submit" name="submit">Post</button>
    </form>
        
</div>


<?php 

    include_once '../footer.php'

?>