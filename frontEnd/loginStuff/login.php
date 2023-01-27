<?php 

    include_once '../header.php'

?>

	<form action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/login.inc.php" method='post'>
		<input type='text' name="username" placeholder="username/email">
		<input type='password' name="password" placeholder="password">
		<button type="submit" name="submit">Sign Up </button>
	</form>

<?php
	
if (isset($_GET["error"])) {
	if ($_GET["error"] == "emptyInput") {
		echo "<p>Fill in all fields!<?p>";
	}
	else if ($_GET["error"] == "smtm1Failed") {
		echo "<p>Something went wrong with the SQL statement when looking up a user.</p>";
	}
	else if ($_GET["error"] == "userInvalid") {
		echo "<p>The username or email is not registered.<?p>";
	}
	else if ($_GET["error"] == "passwordInvalid") {
		echo "<p>The password is not valid.<?p>";
	}

}
?>

        

<?php 

    include_once '../footer.php'

?>