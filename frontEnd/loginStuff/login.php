<?php 

    include_once '../header.php'

?>
<head>
	<link rel="stylesheet" href="login.css">
</head>

<div class="loginDiv">
	<form action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/login.inc.php" method='post'>
		<h1>Log in</h1>
		<input type='text' name="username" placeholder="username/email">
		<input type='password' name="password" placeholder="password">
		<button type="submit" name="submit">Log in </button>
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
				else if ($_GET["error"] == "invalidUser") {
					echo "<p>Please enter either a valid username or an email.<?p>";
					echo "<p>Special characters are not allowed.<?p>";
				}
				else if ($_GET["error"] == "passwordInvalid") {
					echo "<p>The password is not valid.<?p>";
				}
			}
			?>
	</form>
</div>
	

        

<?php 

    include_once '../footer.php'

?>