<?php

    include_once '../header.php';

?>

    <div class="ProfileBox">

        <div class="profileInfo">
            <?php 
                echo '<a> Username: '.$_SESSION['username'].'</a>';
                echo '<a> Email:'.$_SESSION['email'].'</a>';                
            ?>
        </div>

    </div>

<?php 

    include_once '../footer.php'

?>
