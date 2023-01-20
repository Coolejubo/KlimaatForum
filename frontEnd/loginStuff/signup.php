<?php 

	  include '../header.php';

?>

	<form action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/signup.inc.php" method='post'>
		<input type='text' name="username" placeholder="username">
		<input type='text' name="email" placeholder="email">
		<input type='password' name="password" placeholder="password">
		<input type='password' name="psw-repeat" placeholder="repeat password">
		<button type="submit" name="submit">Sign Up </button>
	</form>
			
<?php 

if (isset($_GET["error"])) {
	if ($_GET["error"] == "emptyInput") {
		echo "<p>Fill in all fields!<?p>";
	}
	else if ($_GET["error"] == "pswsDontMatch") {
		echo "<p>Passwords don't match!</p>";
	}
	else if ($_GET["error"] == "usernameExists") {
		echo "<p>This username or email has already been used.</p>";
	}
	else if ($_GET["error"] == "smtm1Failed") {
		echo "<p>Something went wrong with the SQL statement when looking up a user.</p>";
	}
	else if ($_GET["error"] == "smtmFailed") {
		echo "<p>Something went wrong with the SQL statement when adding a user.</p>";
	}
	else if ($_GET["error"] == "none") {
		echo "<p>Sign up succesfull!<?p>";
	}

}

include '../footer.php';

?>
