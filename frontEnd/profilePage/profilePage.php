<?php

    include_once '../header.php';

?>

<head>
    <link rel="stylesheet" href="https://webtech-ki46.webtech-uva.nl/frontEnd/profilePage/editProfile.css">
    <script src="editProfile.js"></script>
</head>


<div class="user-info">
    <img class="profilePic" src="https://api.multiavatar.com/<?php echo $_SESSION['username'] ?>.png?apikey=FgC5ls0LaUYoKd">        
    <form action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/editProfile.inc.php" method="post">
        <div class="user-details">
            <h1>Username</h1>
            <p class="username"><?php echo $_SESSION['username'] ?></p>
            <h2>Email</h1>
            <p class="email"><?php echo $_SESSION['email'] ?></p>
        </div>
        <div class="edit-form" style="display: none;">
            <h1>Username</h1>
            <input type="text" class="usernameInput" name="username" placeholder="<?php echo $_SESSION['username'] ?>">
            <h1>Email</h1>
            <input type="text" class="emailEdit" name="email" placeholder="<?php echo $_SESSION['email'] ?>">
            <button type="submit" name="submit">Save</button>
        </div>
    </form>
</div>

<div class="editButtonDiv">
    <button class="edit-button">Edit</button>
</div>

<?php

if (isset($_GET["error"])) {
	if ($_GET["error"] == "emptyInput") {
		echo "<p>Fill in all fields!<?p>";
	}
	else if ($_GET["error"] == "usernameExists") {
		echo "<p>This username or email has already been used.</p>";
	}
    else if ($_GET["error"] == "smtmFailed") {
		echo "<p>Something went wrong with the SQL statement when adding a user.</p>";
	}
	else if ($_GET["error"] == "none") {
		echo "<p>Sign up succesfull!<?p>";
	}
}

    include_once '../footer.php';
?>
