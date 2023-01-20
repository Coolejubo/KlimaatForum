<?php 

    include_once '../header.php'

?>
<form action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/thread.inc.php" method="post">

	<div class="container">
		<label for="title">Title:</label>
		<input type="text" id="title" name="title">
        <br>
        <br>
        <label for="content">Content:</label>
        <br>
        <textarea name="content" rows="10" cols="30"></textarea> 

	</div>
</form>
        

<?php 

    include_once '../footer.php'

?>