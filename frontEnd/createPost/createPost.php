<?php 

    include_once '../header.php'

?>

<head>
    <link rel="stylesheet" href="https://webtech-ki46.webtech-uva.nl/frontEnd/createPost/createPost.css">
    <style>
        body{
            background-image: none;
            background-color: rgb(103, 169, 181);
        }
    </style>
    </head>

<div class="createPost">

    <form action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/createPost.inc.php" method="post">
            <br>
            <label for="dropdown">Select a forum:</label>
            <select id="topicSelect" name="selectedTopic"> 
                <option value="climateChange">Climate change</option>
                <option value="bioDiversity">Bio diversity</option>
                <option value="air">Air quality</option>
                <option value="water">Water Quality and Availability</option>
                <option value="soil">Soil Health and Conservation</option>
                <option value="energy">Renewable Energy</option>
                <option value="waste">Waste Management</option>
                <option value="conservation">Conservation and Protected Areas</option>
                <option value="policies">Environmental Policy and Law</option>
            </select>            
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
            elseif ($_GET["error"] == "titleTooLong") {
                echo "<p>The title is too long!<?p>";
            }
        }
    ?>
    
</div>


<?php 

    

    include_once '../footer.php'

?>