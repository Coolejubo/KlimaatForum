<?php 

    include_once '../header.php'

?>

<form action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/login.inc.php" method="post">

	<div class="container">
		<label for="uname"><b>Username</b></label>
		<input class="loginInput" type="text" placeholder="Enter Username" name="uname" required>
	
		<label for="psw"><b>Password</b></label>
		<input class="loginInput" type="password" placeholder="Enter Password" name="psw" required>
	
		<button type="submit">Login</button>
		<label>
			<input type="checkbox" checked="checked" name="remember"> Remember me
		</label>
	</div>
	
	<div class="container" style="background-color:#f1f1f1">
		<button type="button" class="cancelbtn">Cancel</button>
		<span class="psw">Forgot <a href="#">password?</a></span>
		<span class="psw">Don't have an account yet? <a href="https://webtech-ki46.webtech-uva.nl/frontEnd/loginStuff/signup.php">
			Sign Up </a></span>
	</div>

</form>
        

<?php 

    include_once '../footer.php'

?>