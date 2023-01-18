<?php 

	  include '../header.php';

?>

        <form action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/signup.inc.php" method='post'>
			<input type='text' name="username" placeholder="username">
			<input type='text' name="email" placeholder="email">
			<input type='text' name="password" placeholder="password">
			<input type='text' name="psw-repeat" placeholder="repeat password">
			<button type="submit" name="submit">Sign Up </button>
        </form>
			
<?php 

include '../footer.php';

?>
