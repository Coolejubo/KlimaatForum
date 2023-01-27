<?php 

    include_once '../header.php'

?>
<?php
session_start();

$username = $_SESSION['username'];
$email = $_SESSION['email'];
$about = $_SESSION['about'];

?>
<div class="ProfileBox">
    <img src="<?php echo $_SESSION['profile_picture']; ?>" class="profile-picture">
    <table style="width:100%">
        <tr>
            <th>Existing Information</th>
            <th></th>
        </tr>
        <tr>
            <td>Username: <?php echo $username; ?></td>
            <td></td>
        </tr>
        <tr>
            <td>Email: <?php echo $email; ?></td>
            <td></td>
        </tr>
        <tr>
            <td>About: <?php echo $about; ?></td>
            <td></td>
        </tr>
    </table>
    <br>
    <table style="width:100%">
        <tr>
            <th>Edit Information</th>
            <th></th>
        </tr>
        <tr>
            <td>Username:</td>
            <td>
                <form action="update_profile.php" method="post">
                    <input type="text" name="new_username" placeholder="New username">
                </form>
            </td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>
                <form action="update_profile.php" method="post">
                    <input type="text" name="new_email" placeholder="New email">
                </form>
            </td>
        </tr>
        <tr>
            <td>About:</td>
            <td>
                <form action="update_profile.php" method="post">
                    <input type="text" name="new_about" placeholder="New about">
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form action="update_profile.php" method="post">
                    <input type="submit" value="Update Profile" class="update-btn">
                </form>
            </td>
            <td></td>
        </tr>
    </table>
</div>
<?php
    include_once '../footer.php';
?>   
