<?php 

	  include '../header.php';

?>
<head>
	<link rel="stylesheet" href="signup.css">
</head>

<div class="signupBox">
	<form action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/signup.inc.php" method='post'>
		<h1>Create an account:</h1>
		<input type='text' name="username" placeholder="username">
		<input type='email' name="email" placeholder="email">
		<input type='password' name="password" placeholder="password">
		<input type='password' name="psw-repeat" placeholder="repeat password">
		<button type="submit" name="submit">Sign Up </button>
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
				else if ($_GET["error"] == "invalidUser") {
					echo "<p>Please enter a valid username, only letters and numbers are allowed!<?p>";
				}
				else if ($_GET["error"] == "invalidEmail") {
					echo "<p>Please enter a valid email, it should contain an @ followed with a domain.<?p>";
				}
			}
			?>
	</form>
</div>
	
			
<?php

include '../footer.php';

?>
